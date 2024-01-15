@extends('layouts.master')

@section('content')
<div class="pagetitle">
    <h1>Practice Report</h1>
    <button class="btn btn-danger" onclick="printTable()">Print</button>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                <!-- Table with stripped rows -->
                <table id="printTable" class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Practice Name</th>
                            <th scope="col">District Name</th>
                            <th scope="col">Practice Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($practiceDetails as $practice)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $practice['practiceName'] }}</td>
                            <td>{{ $practice['districtName'] }}</td>
                            <td>{{ $practice['marks'] }} %</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div><!-- End Left side columns -->
    </div>
</section>

<script>
    function printTable() {
        var title = "<h1> <u> {{App\Helpers\activeYear()->year}} Practice Report </u></h1>"; // Add your title here
        var printContents = title + document.getElementById("printTable").outerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

@endsection
