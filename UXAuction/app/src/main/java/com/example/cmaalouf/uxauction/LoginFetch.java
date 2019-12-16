package com.example.cmaalouf.uxauction;

import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;

import static com.example.cmaalouf.uxauction.MainActivity.pass;
import static com.example.cmaalouf.uxauction.MainActivity.username;
import static com.example.cmaalouf.uxauction.MainActivity.enter;
import static java.lang.String.valueOf;

public class LoginFetch extends AsyncTask<String,String,String> {

    private Context ctx;
    public LoginFetch(Context context)
    {
        this.ctx=context;

    }


    @Override
    protected void onPreExecute()
    {
        super.onPreExecute();
    }



    @Override
    protected String doInBackground(String... strings) {
        try {
            //items.add("before url");
             String user = strings[0];
            String passw = strings[1];
            URL url = new URL("http://jorochial.cs.loyola.edu/php/index.php");
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
            con.setRequestMethod("POST");
            con.setRequestProperty("username","hfranceschi");
            //con.setRequestProperty("password","pwd");
            con.setDoOutput( true );
            con.setDoInput(true);

            OutputStream os = con.getOutputStream();
            Log.w("USR", ""+user);
            Log.w("PSS","hiii"+passw);
            Log.w("OS ",os.toString());
            BufferedWriter writer = new BufferedWriter( new OutputStreamWriter(os, "iso-8859-1"));
            //writer.write(username);
            //writer.write(pass);
            writer.flush();
            writer.close();
            os.close();

            InputStream inputStream = con.getInputStream();
            Log.w("fetchdata ",inputStream.toString());
            //items.add("after input stream");

            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
            String line = "";
            String result = "";

            //items.add("past buffer");
            while ((line=bufferedReader.readLine()) != null) {
                result += line;
                //json+=line;
                Log.w("echo from php", result);


            }



            bufferedReader.close();
            inputStream.close();
            con.disconnect();
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
            // items.add("IO");
        }

        return "";
    }
    @Override
    protected  void onPostExecute(String aVoid)
    {

        super.onPostExecute(aVoid);

    }

}
