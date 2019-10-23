package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
public class SignUpActivity extends AppCompatActivity{

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

    }
    protected void submit(View view)
    {
        Intent myIntent = new Intent( this,
                MainActivity.class );
        this.startActivity( myIntent );

    }
}

