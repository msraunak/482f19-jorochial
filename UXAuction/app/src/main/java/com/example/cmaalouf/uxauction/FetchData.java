package com.example.cmaalouf.uxauction;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
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

import static com.example.cmaalouf.uxauction.ScrollingActivity.items;
import static java.lang.String.valueOf;

public class FetchData extends AsyncTask<String,String,String> {

String data;
String data_parse;
String single_parse;
    private Context ctx;
public FetchData(Context context)
{
    this.ctx=context;
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
     * Purpose: fetch the data for items for the auction
     * @param //String...voids the data types to perform the tasks on
     * @return the results of the task
     */
    @Override
            protected String doInBackground(String... voids) {
                try {
                    //items.add("before url");
                    URL url = new URL("http://jorochial.cs.loyola.edu/php/auctionserver.php");
                    HttpURLConnection con = (HttpURLConnection) url.openConnection();
                    //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
                    con.setRequestMethod("GET");
                    //con.setReadTimeout(150000);
                    //con.setConnectTimeout(100000);
                    con.setDoOutput( true );
                    con.setDoInput(true);

                    //con.connect();
                    //items.add("before input");
                    //int r = con.getResponseCode();

                    //Log.w("response code",valueOf(r));

                        //items.add(valueOf(con.getResponseCode()));
                    //InputStream inputStream = con.getInputStream();
                    //if(con.getInputStream()==null)
                        //items.add("NULLLLL");
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
                        int id = Integer.parseInt(jsonObject.get("id").toString());



                        String name = jsonObject.get("itemName").toString();
                        String desc =jsonObject.get("description").toString();
                        String donor = jsonObject.get("donorName").toString();
                        Double startingBid = Double.valueOf(jsonObject.get("startingBid").toString());
                        Double minInc = Double.valueOf(jsonObject.get("minimumBidInc").toString());
                        Item item = new Item(id,name, desc, startingBid,minInc,donor);

                        URL imgaeUrl = new URL("http://jorochial.cs.loyola.edu/php/idImagePuller.php?id=2");//+id);
                        HttpURLConnection imageCon = (HttpURLConnection) url.openConnection();
                        //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
                        imageCon.setRequestMethod("GET");
                        //con.setReadTimeout(150000);
                        //con.setConnectTimeout(100000);
                        imageCon.setDoOutput( true );
                        imageCon.setDoInput(true);
                        InputStream imageInputStream = imageCon.getInputStream();
                        Log.w("IMfetchdata ",inputStream.toString());
                        //items.add("after input stream");
                        Bitmap bitmap = BitmapFactory.decodeStream(imageInputStream);
                        Log.w("IMbitmap ",bitmap+"");
                        item.setImage(bitmap);
                        imageInputStream.close();
                        imageCon.disconnect();


                        items.add(item);
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
            //ScrollingActivity.json = data;
            super.onPostExecute(aVoid);
            //Log.w("Data dib",""+data);

            //items = items;
        }
        
        /**
         * Purpose: give other classes access to data
         * @return the data computed from doInBackground
         */
        public String getData(){

                return data;
        }


}





