package com.example.cmaalouf.uxauction;

import android.graphics.Bitmap;

import java.util.TreeMap;

public class Item
{

    protected String description;
    private double startingBid;
    protected double minIncrement;
    private String donor;
    protected String name;
    public int id;
    protected Bitmap image;
    private TreeMap<Double, Bidder> biddersForThisItem;

    public Item(int id, String name, String description, double startingBid, double minIncrement, String donor)
    {
        this.name = name;
        this.id = id;
        this.description = description;
        this.startingBid = startingBid;
        this.minIncrement = minIncrement;
        this.donor = donor;
        biddersForThisItem = new TreeMap<>();

    }

    public void setImage(Bitmap bitmap){
        this.image = bitmap;
    }



    /**
     * Purpose: Give other classes access to an items bidders
     * @return map of bids associated with bidders for this item
     */
    public TreeMap<Double, Bidder> getBiddersForThisItem()
    {
        String username = "cmaalouf";
        String password= "1732813";
        String firstName = "chiara";
        String lastName = "maalouf";
        String emailAddress= "cmmaalouf@loyola.edu";
        String billingInfo = "blah";
        biddersForThisItem.put(1.0, new Bidder(username,password, firstName,lastName,emailAddress,billingInfo));
        return this.biddersForThisItem;
    }

    /**
     * Purpose: Give other classes access to an items highest bid
     * Each item has a TreeMap of bids associated with bidders
     * Since TreeMaps are sorted, the last key will be associated with the highest bidder
     * @return the highest bid for this item, which is mapped to its respective bidder
     */
    public double getCurrentHighestBid()
    {
        return biddersForThisItem.lastKey();
    }

    public String getItemDescription()
    {
        return this.description;
    }

    public double getStartingBid()
    {
        return this.startingBid;
    }

    /**
     * Purpose: Tell java how to print Item objects
     * @return the string to print
     */
    @Override
    public String toString()
    {
        String str = "";
        str += this.name + ": " + this.startingBid;
        return str;
    }

}
