package com.example.cmaalouf.uxauction;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;

import java.util.ArrayList;
import java.util.Set;

import static org.junit.Assert.*;

public class DonorTest {
    private String name;
    private String representativeName;
    private String phoneNumber;
    private String address;
    private String emailAddress;
    private Donor donor;
    private Item item;
    private Auction auction;
    private ArrayList<Item> items = new ArrayList<>();
    
    @Before
    public void beforetest()
    {
        donor = new Donor(name, representativeName, phoneNumber, address, emailAddress);
        item = new Item(name, "description", 20.0, 5.0, "donor");
        auction = new Auction(3, 5, items);
        auction.addItem(item, donor);
    }
    
    @After
    public void tearDown()
    {
          name = null;
          representativeName = null;
          phoneNumber = null;
          address = null;
          emailAddress = null;
          donor = null;
    }
    
    
    
    @Test
    public void getItemsDonated() {
       
        assertTrue(donor.getItemsDonated()!=null);
        Set<Item> items = donor.getItemsDonated();
        assertTrue(items.contains(item));
    }

    @Test
    public void testString() {
        
        assertNotNull(donor);
    }
}