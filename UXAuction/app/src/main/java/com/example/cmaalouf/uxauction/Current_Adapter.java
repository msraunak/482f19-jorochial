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

    /**
     * Purpose: method for RecycleView.ViewHolder to call when it needs a new ViewHolder to 
     * represent an item.
     * @param viewGroup the group to add the new view to
     * @param viewType  the type of new view
     * @return the new ViewHolder that holds the new view
     */
    @NonNull
    @Override
    public Current_Adapter.ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int viewType) {
        // change to currentbid_view
        View view = layoutInflater.inflate(R.layout.search_item_view,viewGroup, false);
        return new Current_Adapter.ViewHolder(view);

    }

    /**
     * Purpose: Display data at a position in the data set
     * @param holder the ViewHolder to be updated to represent the contents of the item
     * @param position the position of the item within the data set
     */
    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        //bind the text view with the data received
        String title = data.get(position);
        holder.textTitle.setText(title);

        //similarly you can set new image for each card and description
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
            textTitle = itemView.findViewById(R.id.itemTitle);
            //testDescription = itemView.findViewById(R.id.textDesc);
        }

    }
}
