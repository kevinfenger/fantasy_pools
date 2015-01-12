package fantasy.fantasypoolsv1;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.Toast;

import com.facebook.Request;
import com.facebook.Response;
import com.facebook.Session;
import com.facebook.SessionState;
import com.facebook.UiLifecycleHelper;
import com.facebook.model.GraphUser;
import com.facebook.widget.LoginButton;

import java.util.Arrays;

/**
 * Created by cwenzel on 1/10/2015.
 */
public class FacebookFragment extends Fragment {

    @Override
    public View onCreateView(LayoutInflater inflater,
                             ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_facebook, container, false);
        LoginButton authButton = (LoginButton) view.findViewById(R.id.authButton);
        authButton.setFragment(this);
        authButton.setReadPermissions(Arrays.asList("email"));


        final Button button = (Button) view.findViewById(R.id.normalLoginButton);
        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(v.getContext(), WebViewActivity.class);
                startActivity(intent);
            }
        });

        return view;
    }
    private static final String TAG = "MainFragment";

    private void showShortToast(String message) {
        Context context = this.getActivity();
        CharSequence text = message;
        int duration = Toast.LENGTH_SHORT;

        Toast toast = Toast.makeText(context, text, duration);
        toast.show();
    }
    private void onSessionStateChange(Session session, SessionState state, Exception exception) {
        if (state.isOpened()) {
            String token = session.getAccessToken();
            final Context activity = this.getActivity();

            Request.executeMeRequestAsync(session, new Request.GraphUserCallback() {
                @Override
                public void onCompleted(GraphUser user, Response response) {
                    if (user != null) {
                        String facebookPostString = "user[picture][data][is_silhouette]=false";
                        facebookPostString += "&user[picture][data][url]=http://hatchexperience.org/wp-content/uploads/2013/08/facebook-icon-50x50.jpg";
                        //facebookPostString += "user[picture][data][url]=http://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/p50x50/10881668_922661634411138_8439005081361393288_n.jpg?oh=6fdbc033605d581a966adc2ba9404ced&oe=55340A73&__gda__=1429256261_e3dc1b9b9c35836d63c7af7cac3a2fc1";
                        //facebookPostString += "&__gda__=1429256261_e3dc1b9b9c35836d63c7af7cac3a2fc1";
                        facebookPostString += "&user[first_name]=" + user.getFirstName();
                        facebookPostString += "&user[last_name]=" + user.getLastName();
                        facebookPostString += "&user[id]=" + user.getId();
                        facebookPostString += "&user[email]=" + user.getProperty("email").toString();
                        //facebookPostString += "&token=CAAFbB6cI1d4BAL8g5R6LjoAoHzBq882eRo4Vqx6VEf5K4aunZCBrfJJnDd4yabeyB1bbRLdZCmvWKYhuY7SJacJdZBpuwd386vZCsGczSdHa1VGIieOhcp2vXZBlHTFZAztvhtc3TajUAcNBZC5txQvt68LSXK1gyJPFTucLFdqFdTFL1DKTcSkAtmu8cKYzukaUIT6C038707gpjgj3jD4l9MRbpxIR8gZD";
                        Intent intent = new Intent(activity, WebViewActivity.class);
                        intent.putExtra("facebookPostString", facebookPostString);
                        startActivity(intent);
                    }
                }
            });
            Log.i(TAG, "Logged in...");
        } else if (state.isClosed()) {
            Log.i(TAG, "Logged out...");
        }
    }

    private UiLifecycleHelper uiHelper;

    private Session.StatusCallback callback = new Session.StatusCallback() {
        @Override
        public void call(Session session, SessionState state, Exception exception) {
            onSessionStateChange(session, state, exception);
        }
    };

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        uiHelper = new UiLifecycleHelper(getActivity(), callback);
        uiHelper.onCreate(savedInstanceState);
    }

    @Override
    public void onResume() {
        super.onResume();
        // For scenarios where the main activity is launched and user
        // session is not null, the session state change notification
        // may not be triggered. Trigger it if it's open/closed.
        Session session = Session.getActiveSession();
        if (session != null &&
                (session.isOpened() || session.isClosed()) ) {
            onSessionStateChange(session, session.getState(), null);
        }

        uiHelper.onResume();

    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        uiHelper.onActivityResult(requestCode, resultCode, data);
    }

    @Override
    public void onPause() {
        super.onPause();
        uiHelper.onPause();
    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        uiHelper.onDestroy();
    }

    @Override
    public void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);
        uiHelper.onSaveInstanceState(outState);
    }
}
