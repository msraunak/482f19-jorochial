package com.example.cmaalouf.uxauction;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;

import static org.junit.Assert.*;

public class ItemTest {
    Item item;
    String name;
    Double startbid;
    @Before
    public void beforeTest()
    {
        name = "chess";
        startbid = 10.00;
        item = new Item("chess","a board game",10.00, 1.00, "Dr.Raunak");
    }

    @After
    public void tearDown()
    {
        name =null;
        startbid = null;
        item =null;
    }

    @Test
    public void getBiddersForThisItem() {
        assertTrue(item.getBiddersForThisItem()!=null);

    }

    @Test
    public void getCurrentHighestBid() {
        assertTrue(item.getCurrentHighestBid()>0);
    }

    @Test
    public void testString() {
        assertEquals(item.toString(),name+": "+startbid);

    }
}