package fantasy.fantasypoolsv1;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;

/**
 * Created by cwenzel on 1/12/2015.
 */
public class LocalLoginFragment extends Fragment {

    @Override
    public View onCreateView(LayoutInflater inflater,
                             ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.activity_local_login, container, false);


        //setContentView(R.layout.activity_local_login);
        final EditText emailTextField = (EditText) view.findViewById(R.id.emailTextField);
        final EditText passwordTextField = (EditText) view.findViewById(R.id.passwordTextField);

        final Button button = (Button) view.findViewById(R.id.localLoginButton);
        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                String password = passwordTextField.getText().toString();
                String email = emailTextField.getText().toString();

                SharedPreferences sharedPref = v.getContext().getSharedPreferences(getString(R.string.preference_file_key), Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = sharedPref.edit();
                editor.putString(getString(R.string.username), email);
                //TODO THIS NEEDS TO BE STORED AS OAUTH SOON
                editor.putString(getString(R.string.password), password);
                editor.commit();

                Intent intent = new Intent(v.getContext(), WebViewActivity.class);
                String loginPostString = "password=" + password;
                loginPostString += "&email=" + email;
                intent.putExtra("loginPostString", loginPostString);
                startActivity(intent);
            }
        });

        return view;
    }
}
