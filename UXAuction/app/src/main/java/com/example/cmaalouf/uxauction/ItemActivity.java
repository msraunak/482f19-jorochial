package com.example.cmaalouf.uxauction;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.TextView;

import java.util.ArrayList;

public class ItemActivity extends AppCompatActivity {
 public static ArrayList<Double> items = new ArrayList<>();
    /**
     * Purpose: create the view from the xml layout
     * @param savedInstanceState saved state of application used when this method is called
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bid);
        Intent myIntent = new Intent(this, ItemActivity.class);
        int id = myIntent.getIntExtra("id",0);
        String name = myIntent.getStringExtra("name");
        String desc = myIntent.getStringExtra("desc");
        Double minInc = myIntent.getDoubleExtra("minInc",0);

        TextView itemName = (TextView)findViewById(R.id.itemName);
        TextView itemdesc = (TextView)findViewById(R.id.description);
        TextView itemInc = (TextView)findViewById(R.id.autobid);
        TextView itemAmount= (TextView)findViewById(R.id.cbid);

        itemName.setText(name.toString());
        itemdesc.setText(desc.toString());



    }

    /**
     * Purpose: method for when back button is hit
     * @param view for android onClick convention
     */
    protected void backToSearch(View view)
    {
        this.finish();

    }


}
