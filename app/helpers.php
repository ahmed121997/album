
<?php

/**
 * function to get data using library "yajra/laravel-datatables-oracle"
 * you to install this library
 */
function getDataTables($request , $data){
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn =
                        '<a href="picture/show/' . $row->id . '" class="show btn btn-warning btn-sm">Show</a>
                     <a href="album/edit/' . $row->id . '" class="edit btn btn-success btn-sm">Edit</a>
                      <a href="album/delete/' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }




?>
