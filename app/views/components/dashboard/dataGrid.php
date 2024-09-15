<?php

function dataGrid($tableTitle)
{
    return
        "<div class='w-full border border-blue-500 rounded-xl p-4 bg-fadeWhite'>
            <div>
                <h1>$tableTitle</h1>
                <div>
                    <a href='prev'>'<-'</a>
                    <a href='next'>'->'</a>
                </div>
            </div>
            <div>
                <div class='grid grid-cols-4 place-items-center text-gray pb-4'>
                    <p>Id</p>
                    <p>Seller</p>
                    <p>Status</p>
                    <p>Price</p>
                </div>                
                <div class='grid grid-cols-4 place-items-center'>
                    <p>1001</p>
                    <p>Mickey</p>
                    <p>Mouse</p>
                    <p>Rs.1500</p>
                </div>
                <div class='grid grid-cols-4 place-items-center'>
                    <p>1001</p>
                    <p>Mickey</p>
                    <p>Mouse</p>
                    <p>Rs.1500</p>
                </div>
            </div>
        </div>";
}