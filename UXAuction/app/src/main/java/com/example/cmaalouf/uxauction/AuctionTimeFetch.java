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
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.text.SimpleDateFormat;

public class AuctionTimeFetch extends AsyncTask<String,String,String> {

    String data;
    String data_parse;
    String single_parse;
    private Context ctx;
    private long millis;

    public AuctionTimeFetch(Context context) {
        this.ctx = context;
    }


    @Override
    protected void onPreExecute() {
        super.onPreExecute();
        data = "";
    }


    @Override
    protected String doInBackground(String... voids) {
        try {
            //items.add("before url");
            URL url = new URL("http://jorochial.cs.loyola.edu/php/auctionTime.php");
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
            con.setRequestMethod("GET");
            //con.setReadTimeout(150000);
            //con.setConnectTimeout(100000);
            con.setDoOutput(true);
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
            Log.w("fetchdata ", inputStream.toString());
            //items.add("after input stream");

            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
            String line = "";
            String result = "";
            data = "";
            //items.add("past buffer");
            while ((line = bufferedReader.readLine()) != null) {
                result += line;
                //json+=line;
                Log.w("echo from php", result);
                data = data + line;

            }
            data = result;
            JSONArray jsonArray = new JSONArray(result);
/// GET TIME INSTANCE SIMPLE DATEFORMAT
            for (int i = 0; i < jsonArray.length(); i++) {
                JSONObject jsonObject = (JSONObject) jsonArray.get(i);
                String startTime = jsonObject.get("startTime").toString();
                String endTime = jsonObject.get("startTime").toString();
                startTime = startTime.substring(startTime.length() - 8);
                endTime = endTime.substring(endTime.length() - 8);
                String[] startTimes = startTime.split(":");
                String[] endTimes = endTime.split(":");
                int hoursLeft = Integer.parseInt(endTimes[0]);
                millis = hoursLeft * 60 * 60 * 1000;

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

    @Override
    protected void onPostExecute(String aVoid) {
        //ScrollingActivity.json = data;
        super.onPostExecute(aVoid);
        //Log.w("Data dib",""+data);

        //items = items;
    }

    public long getMillis()
    {
        return millis;
    }
}
