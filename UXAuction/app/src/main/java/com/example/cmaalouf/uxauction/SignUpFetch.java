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
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.Map;

import static com.example.cmaalouf.uxauction.SignUpActivity.success;


public class SignUpFetch extends AsyncTask<String,String,String> {

    private Context ctx;
    public SignUpFetch(Context context)
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
            String email = strings[2];
            String fname = strings[3];
            String lname = strings[4];
            //String user = "hfranceschi";// strings[0];
            //String passw = "pwd";//strings[1];
            URL url = new URL("http://jorochial.cs.loyola.edu/php/signUp.php");



            Map<String,Object> params = new LinkedHashMap<>();
            params.put("username", user );
            params.put("pwd", passw);
            params.put("fname",fname);
            params.put("lname",lname);
            params.put("email",email);

            Log.w("email",""+user);
            StringBuilder postData = new StringBuilder();
            for (Map.Entry<String,Object> param : params.entrySet()) {
                if (postData.length() != 0) postData.append('&');
                postData.append(URLEncoder.encode(param.getKey(), "UTF-8"));
                postData.append('=');
                postData.append(URLEncoder.encode(String.valueOf(param.getValue()), "UTF-8"));
            }
            byte[] postDataBytes = postData.toString().getBytes("UTF-8");



            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
            con.setRequestMethod("POST");
            //con.setRequestProperty("username","hfranceschi");
            //con.setRequestProperty("password","pwd");
            con.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
            con.setRequestProperty("Content-Length", String.valueOf(postDataBytes.length));
            con.setDoOutput( true );
            con.setDoInput(true);

            OutputStream os = con.getOutputStream();
            Log.w("USR", ""+email);
            Log.w("PSS",""+passw);
            Log.w("OS ",os.toString());
            // BufferedWriter writer = new BufferedWriter( new OutputStreamWriter(os, "iso-8859-1"));
            os.write(postDataBytes);
            //writer.write(pass);
            //writer.flush();
            //writer.close();
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
                //json+=line
            }
            Log.w("PHP", result);
            success.add(result.matches("Success"));



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
