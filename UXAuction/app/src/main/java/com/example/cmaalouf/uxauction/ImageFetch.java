package com.example.cmaalouf.uxauction;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.util.Log;
import android.widget.ImageView;

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

import static com.example.cmaalouf.uxauction.ScrollingActivity.images;

import static java.lang.String.valueOf;

public class ImageFetch extends AsyncTask<String,String,String> {

        String data;
        String data_parse;
        String single_parse;
private Context ctx;
public ImageFetch(Context context)
        {
        this.ctx=context;

        }


@Override
protected void onPreExecute()
        {
        super.onPreExecute();
        data ="";
        }


    @Override
    protected String doInBackground(String... voids) {
        try {
            //items.add("before url");
            //Log.w("QUERY", ""+query);
            //query = 2;
            //Log.w("inside im",voids[0]);
            //String query = voids[0];
            String query ="2";
            URL url = new URL("http://jorochial.cs.loyola.edu/php/idImagePuller.php?id="+query);
            HttpURLConnection con = (HttpURLConnection) url.openConnection();
            //Log.w("HHTP STAT", valueOf(con.getResponseCode()));
            con.setRequestMethod("GET");

            con.setDoOutput( true );
            con.setDoInput(true);
            ;
            InputStream inputStream = con.getInputStream();
            Log.w("IMfetchdata ",inputStream.toString());
            //items.add("after input stream");


            Bitmap bitmap = BitmapFactory.decodeStream(inputStream);
            Log.w("bitmap",""+valueOf(bitmap));
            ScrollingActivity.images.add(bitmap);







            inputStream.close();
            con.disconnect();
        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
            // items.add("IO");
        }

        return data;
    }
    @Override
    protected  void onPostExecute(String aVoid)
    {

        super.onPostExecute(aVoid);

    }

}
