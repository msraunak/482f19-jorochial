package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;

import java.util.ArrayList;


/**
 * @author ?????????????????????
 * @version ????????????????????
 */
public class CurrentActivity extends AppCompatActivity{


    public static ArrayList<Item> myItems;
    //private static final long START_TIME_IN_MILIS;
    public static String query;

    /**
     * Purpose: Load the layout of this activity when it is accessed
     * @param savedInstanceState the saved state information to initialize the activity
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_currentscrolling);



        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });

        myItems= new ArrayList<Item>();

        /*myItems.add(add_this);
        myItems.add(add_this);
        myItems.add(add_this);
        myItems.add(add_this);
        myItems.add(add_this);
    */
        query="hfranceschi";
        Log.w("CurrentFetch ", query);
        CurrentFetchData process = new CurrentFetchData(this,"hfranceschi");
        process.execute();
        update();




        //long mTimeLeftInMillis = START_TIME_IN_MILIS; // MAKE CALL
    }


    /**
     * Purpose: Update the view
     */
    public void update(){

        CurrentAdapter Cadapter = new CurrentAdapter(this,myItems);
        RecyclerView CrecyclerView = (RecyclerView) findViewById(R.id.CurrentrecyclerView);
        // set a LinearLayoutManager with default orientation
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext());
        CrecyclerView.setLayoutManager(linearLayoutManager);
        CrecyclerView.setAdapter(Cadapter);
    }

    /**
     * Purpose: initialize the contents of the menu
     * @param menu the menu to place items
     * @return true so the menu is displayed
     */
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_scrolling, menu);
        return true;
    }

    /**
     * Purpose: tell the program what to do when an item is selected
     * @param item the item that was selected
     * @return true if the item was settings, false otherwise to allow normal menu handling
     */
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }


    /**
     * Purpose: Handle the bidder clicking on an item
     * @param view convention for onClick methods
     */
    public void itemClick(View view) {
        Intent myIntent = new Intent(this,
                ItemActivity.class);
        this.startActivity(myIntent);
    }

    /**
     * Purpose: Handle the bidder pressing Current Bids
     * @param view convention for onClick methods
     */
    public void goToCurrent(View view) {
        Intent myIntent = new Intent(this,
                CurrentActivity.class);
        this.startActivity(myIntent);
    }

    /**
     * Purpose: Handle the bidder pressing Past Bids
     * @param view convention for onClick methods
     */
    public void goToPast(View view) {
        Intent myIntent = new Intent(this,
                PastActivity.class);
        this.startActivity(myIntent);
    }

    /**
     * Purpose: Handle the bidder pressing Search Auction
     * @param view convention for onClick methods
     */
    public void goToSearch(View view)
    {

        Intent myIntent = new Intent( this,
                ScrollingActivity.class );
        this.startActivity( myIntent );
    }
}
