@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
<div class="card-body">
                <div id="dashboard-card" class="row" >
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- use axios cdn -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    axios.get('/api/leads/status').then((res)=>{
        var status = res.data;
        // object to array with keys and values
        var statusArray = Object.keys(status).map(function(key) {
            count = status[key];
            name = key;
            return {name: name, count: count};
        });
        
        // create a bootstrap column and card for each status
        statusArray.forEach(function(status){
            var column = document.createElement('div');
            column.className = 'col-4';
            var card = document.createElement('div');
            card.className = 'card elevation-4';
            var cardHeader = document.createElement('div');
            cardHeader.className = 'card-header';
            cardHeader.innerHTML = status.name;
            cardHeader.style.backgroundColor = '#3c4b64';
            cardHeader.style.color = '#fff';
            var cardBody = document.createElement('div');
            cardBody.className = 'card-body';
            cardBody.innerHTML = status.count;
            card.appendChild(cardHeader);
            card.appendChild(cardBody);
            column.appendChild(card);
            document.getElementById('dashboard-card').appendChild(column);

        });
});
</script>
@endsection
@section('scripts')
@parent

@endsection