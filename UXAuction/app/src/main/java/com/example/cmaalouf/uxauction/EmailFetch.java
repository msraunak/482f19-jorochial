package com.example.cmaalouf.uxauction;

import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;
import android.view.View;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class EmailFetch extends AsyncTask<String,String,String> {

        String data;
        String data_parse;
        String single_parse;
private Context ctx;
public EmailFetch(Context context)
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
        data="";
        }

/**
 * Purpose: fetch the data for searching
 * @param ///String...voids the data types to perform the tasks on
 * @return the results of the task
 */
@Override
protected String doInBackground(String... voids) {
    try {
        String email = voids[0];
        String emailMessage= voids[1];
        Log.w("email here",email);
        Log.w("email message",emailMessage);
        URL url = new URL("http://jorochial.cs.loyola.edu/php/sendEmail.php?emailAddress=" + email + "&emailSubject=Forgot Password" + "&emailMessage=" +emailMessage);
        HttpURLConnection con = (HttpURLConnection) url.openConnection();
        //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
        con.setRequestMethod("GET");


        con.setDoOutput(true);
        con.setDoInput(true);


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
        Log.w("error??",result);

        con.disconnect();





    } catch (MalformedURLException e) {
        e.printStackTrace();
    } catch (IOException e) {
        e.printStackTrace();
    }
    return "";
}

        }

