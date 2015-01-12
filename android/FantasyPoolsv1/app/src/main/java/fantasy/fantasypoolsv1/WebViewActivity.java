package fantasy.fantasypoolsv1;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Message;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ScrollView;
import android.widget.Toast;

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
        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            facebookPostString = extras.getString("facebookPostString");
        }

        showIntroToast(savedInstanceState);
        super.onCreate(savedInstanceState);
        mContainer = (ScrollView) findViewById(R.id.scroll_view);
        setContentView(R.layout.activity_browser);

        setupWebView();
        setupSwipeRefresh();

        if (facebookPostString != null) {
            myWebView.postUrl("http://fantasy.kevinfenger.com/user/facebook_login", EncodingUtils.getBytes(facebookPostString, "BASE64"));
        }
        else if (savedInstanceState == null) {
            myWebView.loadUrl("http://fantasy.kevinfenger.com");
        }

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

    private void hitTheFacebookLoginEndpoint()
    {

    }

    private void showIntroToast(Bundle savedInstanceState)
    {
        if (savedInstanceState == null)
            showShortToast("Welcome! Swipe to the top to refresh.");
    }

    private void showShortToast(String message) {
        Context context = getApplicationContext();
        CharSequence text = message;
        int duration = Toast.LENGTH_SHORT;

        Toast toast = Toast.makeText(context, text, duration);
        toast.show();
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
        public boolean shouldOverrideUrlLoading(WebView view, String url) {

            return false;
        }

        @Override
        public void onPageFinished(WebView view, String url)
        {
            if (url.contains("facebook_login"))
                view.loadUrl("http://fantasy.kevinfenger.com");
        }
    }

    class UriChromeClient extends WebChromeClient {

        @Override
        public boolean onCreateWindow(WebView view, boolean isDialog,
                                      boolean isUserGesture, Message resultMsg) {
            showShortToast("onCreateWindow");

           /* Activity host = (Activity) view.getContext();
            Intent intent = new Intent(host, PopupBrowserActivity.class);
            intent.putExtra("url", view.getUrl());
            startActivity(intent);

*/
            return true;
        }
    }
}
