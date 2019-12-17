package com.example.cmaalouf.uxauction;
import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Filter;
import android.widget.Filterable;
import android.widget.TextView;

import java.io.File;
import java.util.ArrayList;
import java.util.List;

public class CurrentAdapter extends RecyclerView.Adapter<CurrentAdapter.ViewHolder> {

    private LayoutInflater layoutInflater;
    private ArrayList<Item> data;
    private ArrayList<Item> fullList;


    public CurrentAdapter(Context context, ArrayList<Item> data){
        this.layoutInflater = LayoutInflater.from(context);
        this.data = data;
        fullList = new ArrayList<>(data);
    }

    /**
     * Purpose: method for RecycleView.ViewHolder to call when it needs a new ViewHolder to 
     * represent an item.
     * @param viewGroup the group to add the new view to
     * @param viewType  the type of new view
     * @return the new ViewHolder that holds the new view
     */
    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int viewType) {
        View view = layoutInflater.inflate(R.layout.currentbid_view,viewGroup, false);
        return new ViewHolder(view);

    }

    /**
     * Purpose: Display data located at a position in the data set
     * @param holder the ViewHolder to be updated to represent the contents of the item
     * @param i the position of the item within the data set
     */
    @Override
    public void onBindViewHolder(@NonNull CurrentAdapter.ViewHolder viewHolder, int i) {
        Item item = data.get(i);
        viewHolder.textTitle.setText(item.name);

    }


    /**
     * Purpose: give other classes access to the size of this data set
     * @return the total number of items in the adapter
     */
    @Override
    public int getItemCount() {
        return data.size();
    }



        public class ViewHolder extends RecyclerView.ViewHolder{
            TextView textTitle, testDescription;

            public ViewHolder(@NonNull View itemView)
            {
                super(itemView);
                textTitle = itemView.findViewById(R.id.name1);
                //testDescription = itemView.findViewById(R.id.textDesc);
            }

        }

}
