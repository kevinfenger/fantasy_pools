package fantasy.fantasypoolsv1;

import android.content.Context;
import android.widget.Toast;

/**
 * Created by cwenzel on 1/13/2015.
 */
public class Utils {
    public static void ShowShortToast(String message, Context context) {
        CharSequence text = message;
        int duration = Toast.LENGTH_SHORT;

        Toast toast = Toast.makeText(context, text, duration);
        toast.show();
    }
}
