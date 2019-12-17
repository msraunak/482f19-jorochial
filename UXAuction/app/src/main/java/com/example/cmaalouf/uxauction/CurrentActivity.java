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



public class CurrentActivity extends AppCompatActivity{

    public static ArrayList<Item> myItems = new ArrayList<>();
    public static String query;
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
        Item add_this = new Item("ho","hi",10.00,100.00,"donor");
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
    }



    public void update(){

        CurrentAdapter Cadapter = new CurrentAdapter(this,myItems);
        RecyclerView CrecyclerView = (RecyclerView) findViewById(R.id.CurrentrecyclerView);
        // set a LinearLayoutManager with default orientation
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext());
        CrecyclerView.setLayoutManager(linearLayoutManager);
        CrecyclerView.setAdapter(Cadapter);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_scrolling, menu);
        return true;
    }

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



    public void itemClick(View view) {
        Intent myIntent = new Intent(this,
                ItemActivity.class);
        this.startActivity(myIntent);
    }

    public void goToCurrent(View view) {
        Intent myIntent = new Intent(this,
                CurrentActivity.class);
        this.startActivity(myIntent);
    }

    public void goToPast(View view) {
        Intent myIntent = new Intent(this,
                PastActivity.class);
        this.startActivity(myIntent);
    }

    public void goToSearch(View view)
    {

        Intent myIntent = new Intent( this,
                ScrollingActivity.class );
        this.startActivity( myIntent );
    }
}