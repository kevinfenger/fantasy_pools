package fantasy.fantasypoolsv1;

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Message;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ScrollView;
import android.widget.Toast;
import fantasy.fantasypoolsv1.Utils;

import org.apache.http.util.EncodingUtils;


public class WebViewActivity extends ActionBarActivity {
    WebView myWebView;
    ScrollView mContainer;
    Context mContext;
    SwipeRefreshLayout refreshLayout;
    String userAgent = "Mozilla/5.0 (Linux; Android 4.2.2; GT-I9505 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.59 Mobile Safari/537.36";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        String facebookPostString = null;
        String loginPostString = null;
        boolean createAccount = false;
        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            facebookPostString = extras.getString("facebookPostString");
            loginPostString = extras.getString("loginPostString");
            createAccount = extras.getBoolean("createAccount");
        }

        showIntroToast(savedInstanceState);
        super.onCreate(savedInstanceState);



        mContainer = (ScrollView) findViewById(R.id.scroll_view);
        setContentView(R.layout.activity_browser);

        getSupportActionBar().setDisplayHomeAsUpEnabled(false);

        setupWebView();
        setupSwipeRefresh();

        if (facebookPostString != null) {
            myWebView.postUrl("http://fantasy.kevinfenger.com/user/facebook_login", EncodingUtils.getBytes(facebookPostString, "BASE64"));
        }
        else if (loginPostString != null) {
            myWebView.postUrl("http://fantasy.kevinfenger.com/user/login_local_user", EncodingUtils.getBytes(loginPostString, "BASE64"));
        }
        else if (createAccount) {
            myWebView.loadUrl("http://fantasy.kevinfenger.com/login");
            Utils.ShowShortToast("Please click 'Create Account' to proceed", this);
        }
        else if (savedInstanceState == null) {
            myWebView.loadUrl("http://fantasy.kevinfenger.com");
        }

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu items for use in the action bar
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.webview_action_bar, menu);

        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle presses on the action bar items
        switch (item.getItemId()) {
            case R.id.action_logout:
                doLogout();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    @Override
    public void onBackPressed(){
        new AlertDialog.Builder(this)
                .setTitle("Really Exit?")
                .setMessage("Are you sure you want to exit?")
                .setNegativeButton(android.R.string.no, null)
                .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {

                    public void onClick(DialogInterface arg0, int arg1) {
                        Intent intent = new Intent(Intent.ACTION_MAIN);
                        intent.addCategory(Intent.CATEGORY_HOME);
                        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                        startActivity(intent);
                    }
                }).create().show();
    }

    private void doLogout() {
        myWebView.loadUrl("http://fantasy.kevinfenger.com/user/logout");
        myWebView.clearCache(true);
        Intent intent = new Intent(this, FacebookActivity.class);
        intent.putExtra("logout", true);
        startActivity(intent);
    }

    @Override
    protected void onSaveInstanceState(Bundle outState )
    {
        super.onSaveInstanceState(outState);
        myWebView.saveState(outState);
    }

    @Override
    protected void onRestoreInstanceState(Bundle savedInstanceState)
    {
        super.onRestoreInstanceState(savedInstanceState);
        myWebView.restoreState(savedInstanceState);
    }

    private void showIntroToast(Bundle savedInstanceState)
    {
        if (savedInstanceState == null)
            Utils.ShowShortToast("Welcome! Swipe to the top to refresh.", this);
    }

    private void setupWebView()
    {
        myWebView = (WebView) findViewById(R.id.webView);
        WebSettings webSettings = myWebView.getSettings();
        webSettings.setUserAgentString(userAgent);
        webSettings.setJavaScriptEnabled(true);
        webSettings.setJavaScriptCanOpenWindowsAutomatically(true);
        myWebView.setWebViewClient(new UriWebViewClient());
        myWebView.setWebChromeClient(new UriChromeClient());
    }

    private void setupSwipeRefresh()
    {
        refreshLayout = (SwipeRefreshLayout) findViewById(R.id.swipe_container);
        refreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                myWebView.reload();
                refreshLayout.setRefreshing(false);
            }
        });
    }


    private class UriWebViewClient extends WebViewClient {

        @Override
        public void onPageFinished(WebView view, String url)
        {
            if (url.contains("facebook_login") || url.contains("login_local_user"))
                view.loadUrl("http://fantasy.kevinfenger.com");
        }
    }

    class UriChromeClient extends WebChromeClient {

    }
}
