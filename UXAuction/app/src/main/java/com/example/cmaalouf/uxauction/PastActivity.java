package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;

import java.util.ArrayList;

public class PastActivity extends AppCompatActivity {

    public static ArrayList<Item> myItems = new ArrayList<Item>();
    public static RecyclerView pastRecyclerView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pastscrolling);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("logOut", null).show();

            }
        });


        Item add_this = new Item("ho","hi",10.00,100.00,"donor");
        myItems.add(add_this);
        myItems.add(add_this);
        myItems.add(add_this);
        myItems.add(add_this);
        myItems.add(add_this);
        PastAdapter pastAdapter = new PastAdapter(this, myItems);
         RecyclerView pastRecyclerView = findViewById(R.id.PastrecyclerView);
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext());
        pastRecyclerView.setLayoutManager(linearLayoutManager);
        pastRecyclerView.setAdapter(pastAdapter);
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

    protected void itemClick(View view) {
        Intent myIntent = new Intent(this,
                ItemActivity.class);
        this.startActivity(myIntent);
    }

    protected void goToCurrent(View view) {
        Intent myIntent = new Intent(this,
                CurrentActivity.class);
        this.startActivity(myIntent);
    }

    protected void goToPast(View view) {
        Intent myIntent = new Intent(this,
                PastActivity.class);
        this.startActivity(myIntent);
    }
    protected void goToSearch(View view)
    {

        Intent myIntent = new Intent( this,
                ScrollingActivity.class );
        this.startActivity( myIntent );
    }
    protected void logOut(View view)
    {
        Intent myIntent = new Intent( this,
                ScrollingActivity.class );
        finish();
        this.startActivity( myIntent );
    }
}