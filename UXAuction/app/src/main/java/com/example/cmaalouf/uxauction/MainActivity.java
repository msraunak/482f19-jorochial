package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {


    ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        // get the reference of RecyclerView


        setContentView(R.layout.activity_login);//activity_list_view);

/*


        */

    }

    protected void login(View view)
    {
        Intent myIntent = new Intent( this,
                ScrollingActivity.class );
        this.startActivity( myIntent );

    }


    protected void forgotPassword(View view)
    {
        Intent myIntent = new Intent( this,
                PasswordRecoveryActivity.class );


        this.startActivity( myIntent );

    }


    protected void signUp(View view)
    {
        Intent myIntent = new Intent( this,
                SignUpActivity.class );
        this.startActivity( myIntent );

    }
}
