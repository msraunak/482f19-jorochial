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

public class Adapter extends RecyclerView.Adapter<Adapter.ViewHolder>  implements Filterable{

    private LayoutInflater layoutInflater;
    private ArrayList<Item> data;
    private ArrayList<Item> fullList;

    Adapter(Context context, ArrayList<Item> data){
        this.layoutInflater = LayoutInflater.from(context);
        this.data = data;
        fullList = new ArrayList<>(data);
    }


    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int viewType) {
        View view = layoutInflater.inflate(R.layout.search_item_view,viewGroup, false);
        return new ViewHolder(view);

    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        //bind the text view wiht the data recieved
        Item item = data.get(position);
        holder.textTitle.setText(item.name);

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
    @Override
    public Filter getFilter(){
        return examplerFilter;
    }

    private Filter examplerFilter = new Filter(){
        @Override
        protected FilterResults performFiltering(CharSequence constraint){
            List<Item> filteredList = new ArrayList<>();
            if(constraint==null || constraint.length()==0){
                filteredList.addAll(fullList);
            }else{
                String filterPattern = constraint.toString().toLowerCase().trim();
                for (Item myItem:fullList){
                    if(myItem.name.toLowerCase().contains(filterPattern)){
                        filteredList.add(myItem);
                    }
                    else if(myItem.description.toLowerCase().contains(filterPattern)){
                        filteredList.add(myItem);
                    }
                }
            }

            FilterResults results = new FilterResults();
            results.values = filteredList;
            return results;
        }
        @Override
        protected void publishResults(CharSequence constraint,FilterResults results){
            data.clear();
            data.addAll((List) results.values);
            notifyDataSetChanged();
        }
    };
}
