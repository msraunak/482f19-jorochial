package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import java.util.ArrayList;

public class SignUpActivity extends AppCompatActivity{
    public static ArrayList<Boolean> success = new ArrayList<>();
    
    /**
     * Purpose: Initialize activity data and the layout from the xml
     * @param savedInstanceState saved state information used in creation
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        success.add(false);
        setContentView(R.layout.activity_signup);

    }
    
    /**
     * Purpose: handle the clicking of the submit button
     * @param view convention for android onClicks
     */
    protected void submit(View view)
    {
        EditText user = (EditText)findViewById(R.id.usernameField);
        String username = user.getText().toString();
        EditText passw = (EditText)findViewById(R.id.passwrdField);
        String pass = passw.getText().toString();
        EditText emailT = (EditText)findViewById(R.id.emailField);
        String email = emailT.getText().toString();

        EditText fnameT = (EditText)findViewById(R.id.fnameField);
        String fname = fnameT.getText().toString();

        EditText lnameT = (EditText)findViewById(R.id.lnameField);
        String lname = lnameT.getText().toString();
        SignUpFetch process = new SignUpFetch(this);
        process.execute(username,pass,email,fname,lname);

        if(success.get(success.size()-1)==true) {
            Intent myIntent = new Intent(this,
                    MainActivity.class);
            this.startActivity(myIntent);
        }


    }
}

