package com.example.cmaalouf.uxauction;

import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;

import static com.example.cmaalouf.uxauction.CurrentActivity.myItems;
import static com.example.cmaalouf.uxauction.CurrentActivity.query;

import static java.lang.String.valueOf;

public class CurrentFetchData extends AsyncTask<String,String,String> {

    String data;
    String data_parse;
    String single_parse;
    //String query;
    private Context ctx;
    public CurrentFetchData(Context context, String query)
    {
        this.ctx=context;
        //this.query=query;

    }

    /**
     * Purpose: execute before doInBackground, initialize data to an empty string
     */
    @Override
    protected void onPreExecute()
    {
        super.onPreExecute();
        data ="";
    }

    /**
     * Purpose: fetch the data for current bids
     * @param //String...voids the data types to perform the tasks on
     * @return the results of the task
     */
    @Override
    protected String doInBackground(String... voids) {
        try {
            //items.add("before url");
            //String query = voids[0];
            //query = "hfranceschi";
            URL url = new URL("http://jorochial.cs.loyola.edu/php/currentBids.php?username="+query);
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
            con.setRequestMethod("GET");

            con.setDoOutput( true );
            con.setDoInput(true);
            ;
            InputStream inputStream = con.getInputStream();
            Log.w("fetchdata ",inputStream.toString());
            //items.add("after input stream");

            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
            String line = "";
            String result = "";
            data = "";
            //items.add("past buffer");
            while ((line=bufferedReader.readLine()) != null) {
                result += line;
                //json+=line;
                Log.w("echo from php", result);
                data = data +line;

            }
            data = result;
            JSONArray jsonArray = new JSONArray(result);
            for(int i = 0; i<jsonArray.length(); i++) {
                JSONObject jsonObject = (JSONObject) jsonArray.get(i);
                int id = Integer.parseInt(jsonObject.get("itemId").toString());
                String name = jsonObject.get("ItemName").toString();
                String desc =" ";
                String donor = " ";
                Double startingBid = Double.valueOf(jsonObject.get("amount").toString());
                Double minInc = 0.00;
                Item item = new Item(id,name, desc, startingBid,minInc,donor);
                myItems.add(item);
            }

            bufferedReader.close();
            inputStream.close();
            con.disconnect();
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
            // items.add("IO");
        } catch (JSONException e) {
            e.printStackTrace();
        }

        return data;
    }
    
    /**
     * Purpose: Run in the UI thread after doInBackground
     * @param aVoid the String result from doInBackground
     */
    @Override
    protected  void onPostExecute(String aVoid)
    {

        super.onPostExecute(aVoid);

    }
    
    /**
     * Purpose: give other classes access to data
     * @return the data computed from doInBackground
     */
    public String getData(){

        return data;
    }


}





