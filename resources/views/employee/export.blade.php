<table class="table table-hover">
    <thead>
        <tr>
            <th>StaffID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Company</th>
        </tr>
    </thead>
    <tbody id="category_table">
        @foreach($employees as $key => $e)
            <tr>
                <td><?= $e->staff_id ?></td>
                <td><?= $e->first_name .' '. $e->last_name ?></td>
                <td><?= $e->department ?></td>
                <td><?= $e->email ?></td>
                <td><?= $e->phone_number ?></td>
                <td><?= $e->address ?></td>
                <td><?= $e->company ? $e->company->name : '-' ?></td>
                
            </tr>
        @endforeach
    </tbody>
</table>