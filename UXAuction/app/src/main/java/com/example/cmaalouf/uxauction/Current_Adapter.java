package com.example.cmaalouf.uxauction;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.List;

public class Current_Adapter extends RecyclerView.Adapter<Current_Adapter.ViewHolder>
{
    private LayoutInflater layoutInflater;
    private List<String> data;

    Current_Adapter(Context context, List<String> data){
        this.layoutInflater = LayoutInflater.from(context);
        this.data = data;
    }


    @NonNull
    @Override
    public Current_Adapter.ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int viewType) {
        // change to currentbid_view
        View view = layoutInflater.inflate(R.layout.search_item_view,viewGroup, false);
        return new Current_Adapter.ViewHolder(view);

    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        //bind the text view with the data received
        String title = data.get(position);
        holder.textTitle.setText(title);

        //similarly you can set new image for each card and description
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
            textTitle = itemView.findViewById(R.id.itemTitle);
            //testDescription = itemView.findViewById(R.id.textDesc);
        }

    }
}
