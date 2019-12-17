package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;

public class ItemActivity extends AppCompatActivity {

    /**
     * Purpose: create the view from the xml layout
     * @param savedInstanceState saved state of application used when this method is called
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bid);

    }

    /**
     * Purpose: method for when back button is hit
     * @param view for android onClick convention
     */
    protected void backToSearch(View view)
    {
        this.finish();

    }


}
