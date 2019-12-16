package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.StrictMode;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;



import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;
import java.util.List;

public class ScrollingActivity extends AppCompatActivity {

    List<Item> itemList;
    ListView listView;
    public static ArrayList<String> items = new ArrayList<String>();
    public static RecyclerView recyclerView;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list_view);


        Toolbar toolbar = (Toolbar) findViewById(R.id.Mytoolbar);
        setSupportActionBar(toolbar);
        toolbar.setSubtitleTextColor(getResources().getColor(R.color.white));
        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });




        FetchData process = new FetchData(this);
        process.execute();
        update();


    }
    private void update()
    {

        Adapter adapter = new Adapter(this,items);
        recyclerView = (RecyclerView) findViewById(R.id.recyclerView);
        // set a LinearLayoutManager with default orientation
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(linearLayoutManager);
        recyclerView.setAdapter(adapter);
//        Current_Adapter adapter1 = new Current_Adapter(this, items);
//        recyclerView.setAdapter(adapter1);
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

    protected void itemClick(View view)
    {
        Intent myIntent = new Intent( this,
                ItemActivity.class );
        this.startActivity( myIntent );
    }

    protected void goToCurrent(View view)
    {
        Intent myIntent = new Intent( this,
                CurrentActivity.class );
        this.startActivity( myIntent );
    }
    protected void goToPast(View view)
    {
        Intent myIntent = new Intent( this,
                PastActivity.class );
        this.startActivity( myIntent );
    }

    protected void goToSearch(View view)
    {

        Intent myIntent = new Intent( this,
                ScrollingActivity.class );
        this.startActivity( myIntent );
    }

    protected void logout(View view)
    {

        Intent myIntent = new Intent( this,
                MainActivity.class );
        this.startActivity( myIntent );
    }
}
