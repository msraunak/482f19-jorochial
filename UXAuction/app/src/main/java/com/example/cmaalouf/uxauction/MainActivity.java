package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

    }

    protected void login(View view)
    {
        Intent myIntent = new Intent( this,
                ScrollingActivity.class );
        this.startActivity( myIntent );

    }


    protected void forgotPassword(View view)
    {
        //Intent myIntent = new Intent( this,
       //         ScrollingActivity.class );

        //Robby to replace Scrolling Activity.class above with the name of the Forgot Password screen and
        // uncomment above code

        // un comment below
        //this.startActivity( myIntent );

    }
}
