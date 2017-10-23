<div class="row">
    <div class="col-md-12 table-responsive p-0">
        <table width="100%" class="table table-bordered">
            <thead>
            <tr class="bg-black-darker text-white">

                <th width="94">#</th>
                <th width="104">Title</th>
                <th width="270">Site Link</th>
                <th width="120">Status</th>
                <th>Description</th>
                <th width="100">Action</th>

            </tr>
            </thead>
            <tbody>

            @foreach($assets as $asset)
                <tr>
                    <td scope="row">
                    {{$asset->id}}</th>
                    <td>{{$asset->title}}</td>
                    <td>{{$asset->site_link}}</td>

                    <td>
                        @if($asset->status=="0")
                            <a href="javascript:" data-id="{{$asset->id}}" data-install="install"
                               class="btn btn-success btn-xs btn-block">Install Me!!</a>
                        @else
                            <a href="javascript:" data-id="{{$asset->id}}" data-install="uninstall"
                               class="btn btn-danger btn-xs btn-block">Un Install</a>
                        @endif
                    </td>

                    <td class="details">
                        <div class="hide show" data-show-id="sortdetails">{{ str_limit($asset->description,50) }}
                            <a href="#" class="actionshow" data-id="fulldetails"><i class="fa fa-arrow-down"></i></a>
                        </div>
                        <div class="hide" data-show-id="fulldetails">{{$asset->description}}
                            <a href="#" class="actionshow" data-id="sortdetails"><i class="fa fa-arrow-up"></i></a>
                        </div>
                    </td>
                    <td>

                        <a href="/admin/resources/core_assest/update/{{$asset->id}}"
                           class="btn btn-default btn-primary btn-xs">&nbsp;<i class="fa fa-pencil-square-o"></i>&nbsp;</a>
                        <a href="/admin/resources/core_assest/delete/{{$asset->id}}"
                           class="btn btn-danger btn-primary btn-xs" onclick="return confirm('Are you sure to delete')">
                            &nbsp;<i class="fa fa-trash"></i> &nbsp;</a></td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

</div>   

