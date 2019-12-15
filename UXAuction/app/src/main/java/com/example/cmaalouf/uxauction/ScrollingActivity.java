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

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

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
    private RequestQueue mQueue;


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
        Current_Adapter adapter1 = new Current_Adapter(this, items);
        recyclerView.setAdapter(adapter1);
    }




    private void makeAuction() {

        final ArrayList<String> myItems = new ArrayList<String>();
        String url = "https://api.myjson.com/bins/pj6jk";//"http://jorochial.cs.loyola.edu/html/auctionserver.php";
        items.add("before jsonrequest");
        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null,new Response.Listener<JSONObject>() {

            @Override
            public void onResponse(JSONObject response) {
                items.add("after request");
                try {
                    JSONArray jsonArray = response.getJSONArray("items");
                    myItems.add("we got the array");

                    for(int i =0; i< jsonArray.length(); i++) {
                        JSONObject item = jsonArray.getJSONObject(i);
                        String firstName = item.getString("itemName");
                        items.add(firstName);
                    }

                } catch (JSONException e) {
                    e.printStackTrace();
                    items.add("json execption");
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
                items.add("stack trace err");
            }
        });


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
