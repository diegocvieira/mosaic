<?php

function _getActiveStores()
{
    return explode(',', _getStoreCookie());
}

function _isStoreActive($store_id)
{
    if (in_array($store_id, explode(',', _getStoreCookie()))) {
        return true;
    } else {
        return false;
    }
}

function _getStoreCookie()
{
    return Cookie::get('stores_id');
}

function _saveImage($file)
{
    $imageName = uniqid() . '.' . $file->getClientOriginalExtension();

    $file->storeAs('uploads', $imageName, 'public');

    return $imageName;
}
