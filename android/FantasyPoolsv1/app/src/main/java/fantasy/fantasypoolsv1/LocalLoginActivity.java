package fantasy.fantasypoolsv1;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v4.app.FragmentActivity;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.ActionBarActivity;
import android.view.View;
import android.webkit.WebView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ScrollView;

import org.apache.http.util.EncodingUtils;

/**
 * Created by cwenzel on 1/12/2015.
 */
public class LocalLoginActivity extends FragmentActivity {
    private LocalLoginFragment localLoginFragment;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        if (savedInstanceState == null) {
            // Add the fragment on initial activity setup
            localLoginFragment = new LocalLoginFragment();
            getSupportFragmentManager()
                    .beginTransaction()
                    .add(android.R.id.content, localLoginFragment)
                    .commit();
        } else {
            // Or set the fragment from restored state info
            localLoginFragment = (LocalLoginFragment) getSupportFragmentManager()
                    .findFragmentById(android.R.id.content);
        }

    }

}
