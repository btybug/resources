<div class="row">
    <div class="col-sm-12 p-0">

        <table width="100%" class="table table-bordered">
            <thead>
            <tr class="bg-black-darker text-white">
                <th width="45" align="center" class="text-center">#</th>
                <th width="104">Title</th>
                <th width="270">Site Link</th>
                <th>Description</th>
                <th width="100">Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($assets as $asset)
                <tr>
                    <td scope="row" align="center">
                    {{$asset->id}}</th>
                    <td>{{$asset->title}}</td>
                    <td>{{$asset->site_link}}</td>
                    <td class="details">{{$asset->description}} </td>
                    <td><a href="/admin/resources/core_assest/update/{{$asset->id}}"
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
