package com.example.cmaalouf.uxauction;

import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.os.StrictMode;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.SearchView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
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
import java.util.Locale;

import static java.lang.String.valueOf;

public class ScrollingActivity extends AppCompatActivity {

    List<Item> itemList;
    ListView listView;
    public static String json ="";
    public static String query="";
    public static ArrayList<Item> items = new ArrayList<Item>();
    public static ArrayList<Bitmap> images = new ArrayList<Bitmap>();
    public static RecyclerView recyclerView;
    private Adapter adapter;
    private TextView tvCountDown;


    /**
     * Purpose: intialize activity data and the layout from the xml
     * @param savedInstanceState the saved state information to initialize the activity
     */
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


        items.clear();
        FetchData process = new FetchData(this);
        //FetchData process = new FetchData(this);
        process.execute();
        getImages();
        //String s = ""+process.getData();
        Auction auction = new Auction(0,0,null);
        Log.w("images size",""+images.size());
        //auction.makeAuctionItems(json);
        //items = auction.getItemsInAuction();
        //adapter = new Adapter(this, items);



        // THIS WORKS ISH
        final SearchView searchView = (SearchView) findViewById(R.id.ItemSearch);
        searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            /**
             * Purpose: search for a query
             * @param s the query to search
             * @return false
             */
            @Override
            public boolean onQueryTextSubmit(String s) {
                //SearchFetchData process = new SearchFetchData(this);
                //process.execute();
                //searchUpdate();
                //update();
                items.clear();
                query= searchView.getQuery().toString();
                searchUpdate();
                return false;
            }
            /**
             * Purpose: update search results when query changes
             * @param newText the query to search
             * @return false
             */
            @Override
            public boolean onQueryTextChange(String newText) {
                items.clear();
                query= searchView.getQuery().toString();
                searchUpdate();
                return false;
            }
        });



    }

    private void getImages()
    {
        Log.w("items size",""+items.size());
        for(Item thisItem : items){
            ImageFetch fetch = new ImageFetch(this);
            fetch.execute();//""+thisItem.id);
            if(images.size()>0) {
                thisItem.setImage(images.get(images.size() - 1));
            }
            Log.w("items image", valueOf(thisItem.image));
        }
        Log.w("now images size",""+images.size());
        update();
    }


    /**
     * Purpose: update the search view
     */
    private void searchUpdate()
    {
        SearchFetchData process = new SearchFetchData(this);
        process.execute();
        update();
    }

    /**
     * Purpose: update the view
     */
    private void update()
    {
        Log.w("UPDATE items size",""+items.size());
        Adapter adapter = new Adapter(this,items);
        recyclerView = (RecyclerView) findViewById(R.id.recyclerView);
        // set a LinearLayoutManager with default orientation
        LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(linearLayoutManager);
        recyclerView.setAdapter(adapter);

//        Current_Adapter adapter1 = new Current_Adapter(this, items);
//        recyclerView.setAdapter(adapter1);

        //Current_Adapter adapter1 = new Current_Adapter(this, items);
        //recyclerView.setAdapter(adapter1);

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
    protected void itemClick(View view)
    {
        Intent myIntent = new Intent( this,
                ItemActivity.class );
        this.startActivity( myIntent );
    }

    /**
     * Purpose: Handle the bidder pressing Current Bids
     * @param view convention for onClick methods
     */
    public void goToCurrent(View view)
    {
        Intent myIntent = new Intent( this,
                CurrentActivity.class );
        this.startActivity( myIntent );
    }

    /**
     * Purpose: Handle the bidder pressing Past Bids
     * @param view convention for onClick methods
     */
    public void goToPast(View view)
    {
        Intent myIntent = new Intent( this,
                PastActivity.class );
        this.startActivity( myIntent );
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

    /**
     * Purpose: Handle the bidder pressing log out
     * @param view convention for onClick methods
     */
    protected void logout(View view)
    {

        Intent myIntent = new Intent( this,
                MainActivity.class );
        this.startActivity( myIntent );
    }

}
