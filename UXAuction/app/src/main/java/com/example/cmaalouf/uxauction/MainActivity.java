package com.example.cmaalouf.uxauction;

import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.media.Image;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.List;

import static java.lang.String.valueOf;


public class MainActivity extends AppCompatActivity {
    public static String username;
    public static String pass;
    public static String verified;
    public static ArrayList<Boolean> enter;
    public static ArrayList<Bitmap> image = new ArrayList<>();
    ListView listView;

    /**
     * Purpose: intialize activity data and the view from the layout xml
     * @param savedInstanceState saved state information for this method to use when called
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        // get the reference of RecyclerView
        this.verified ="";
        this.username ="hfranceschi";
        this.pass ="pwd";
        enter = new ArrayList<Boolean>();

        enter.add(false);
        setContentView(R.layout.activity_login);//activity_list_view);

        update();


    }


    public void update()
    {
        
    }


    /**
     * Purpose: log the user in to the app if they enter their correct information
     * @param view convention for android onClick methods
     */
    protected void login(View view)
    {
        EditText user = (EditText)findViewById(R.id.user);
        username = user.getText().toString();
        EditText passw = (EditText)findViewById(R.id.password);
        pass = passw.getText().toString();
        LoginFetch process = new LoginFetch(this);
        process.execute(username,pass);

        verified();
    }

    /**
     * Purpose: verify the user's log in information
     */
    protected void verified()
    {
        Log.w("enter",""+verified);

        if(enter.get(enter.size()-1)) {
            Intent myIntent = new Intent(this,
                    ScrollingActivity.class);
            this.startActivity(myIntent);
        }
    }


    /**
     * Purpose: take the user to the forgot password screen
     * @param view convention for android onClick methods
     */
    protected void forgotPassword(View view)
    {
        Intent myIntent = new Intent( this,
                PasswordRecoveryActivity.class );


        this.startActivity( myIntent );

    }

    /**
     * Purpose: take the user to the sign up screen
     * @param view convention for onClick methods
     */
    protected void signUp(View view)
    {
        Intent myIntent = new Intent( this,
                SignUpActivity.class );
        this.startActivity( myIntent );

    }
}
