<?php

function _getActiveStores()
{
    return explode(',', Cookie::get('stores_id'));
}
