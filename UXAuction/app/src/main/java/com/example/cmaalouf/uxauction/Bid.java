package com.example.cmaalouf.uxauction;
/**
 * NO JAVADOC COMMENTS ????
 * ????????????????????????
 */
public class Bid {

    protected int bidId;  // Why protected?
    protected String bidderUName;
    protected double amount;
    protected int itemId;
    public Bid(int bidId, String bidderUName, double amount, int itemId)
    {
        this.bidId=bidId;
        this.bidderUName=bidderUName;
        this.amount = amount;
        this.itemId=itemId;
    }
}
