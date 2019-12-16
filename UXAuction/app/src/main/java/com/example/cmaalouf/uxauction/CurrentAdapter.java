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


    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int viewType) {
        View view = layoutInflater.inflate(R.layout.currentbid_view,viewGroup, false);
        return new ViewHolder(view);

    }

    @Override
    public void onBindViewHolder(@NonNull CurrentAdapter.ViewHolder viewHolder, int i) {
        Item item = data.get(i);
        viewHolder.textTitle.setText(item.name);

    }



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
