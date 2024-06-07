@extends('layouts.mainlayout')

@section('title', 'Dasboard')

@section('content')
<div class="row">
    <div class="col-6">
        <form action="" method="get">
            <div class="d-flex">
                <select name="anggaran" class="form-select me-2 w-50" aria-label="Default select example" id="unit">
                    <option selected disabled>MASUKKAN TAHUN DIPA</option>
                    @foreach ($dipa as $item)
                        <option value="{{ $item->id }}">{{ $item->jenis_dipa }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary ms-2">Cari</button>
            </div>
        </form>
    </div>
    <div class="col-6 d-flex justify-content-end">
        @if (Auth::user()->role_id == 3)
            @if (count($stafAnggaran) > 0)
                <a href="/staf-kebutuhan-anggaran" class="btn btn-info"><b>ANGGARAN TELAH CAIR</b></a>
            @endif
            @if (count($revisiDana) > 0)
                <a href="/staf-kebutuhan-anggaran" class="btn btn-info"><b>ANGGARAN DI REVISI</b></a>
            @endif
        @endif
    </div>
</div>

<div class="row mt-5">
    <div class="col-6">
        <div id="cartData"></div>
    </div>
    <div class="col-6">
        <div id="cartData2"></div>
    </div>
</div>
<div class="row mt-5">
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">STAF</th>
                    <th scope="col">TOTAL PENGELUARAN</th>
                    <th scope="col">TANGGAL</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @if (count($dataKeuangan) > 0)
                    @foreach ($dataKeuangan as $item)
                        <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->staf }}</td>
                        <td>{{ number_format($item->realisasi, 0, '.', '.') }}</td>
                        <td>{{ $item->tanggal }} {{ $item->bulan }} {{ $item->tahun }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">TOTAL PENGGUNAAN DANA<th>{{ number_format($total, 0, '.', '.') }}</th><th></th></th>
                    </tr>
                @else
                    <tr><td colspan="12" class="text-center">Tidak ada Data</td></tr> 
                @endif
        </table>
    </div>
</div>

@endsection

@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src ="https://code.highcharts.com/modules/accessibility.js"> </script>
<script>
    var data =  @json($data);
    var categories = [];
    var chartData = [];

    data.forEach(function(item) {
        categories.push(item.bulan);
        chartData.push(item.total);
    });

    Highcharts.chart('cartData', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Penggunaan Anggaran Bulanan'
        },

        xAxis: {
            categories: categories,
        },
        yAxis: {
            title: {
                text: 'Pengeluaran'
                    },
            labels: {
                formatter: function() {
                    return this.value;
                }
            }
        },
        tooltip: {
            shared: true,
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Dipa Bulanan',
            data: chartData

        }]
    });


    var staf = @json($staf);
    var namaStaf = [];
    var totalPemakaiaan = [];
    
    staf.forEach(function(item) {
        namaStaf.push(item.staf);
        totalPemakaiaan.push(item.total);
    });

    var seriesData = [];

        // Loop melalui array nama dan total
        for (var i = 0; i < namaStaf.length; i++) {
            seriesData.push({
                name: namaStaf[i],
                y: totalPemakaiaan[i]
            });
        }

    Highcharts.chart('cartData2', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'DATA ANGGARAN STAF',
            align: 'center'
        },
        subtitle: {
            // text: 'Source: ' +
            //     '<a href="https://www.counterpointresearch.com/global-smartphone-share/"' +
            //     'target="_blank">Counterpoint Research</a>',
            // align: 'left'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            // pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
                name: 'total',
                data: seriesData
            }]
    });
</script>
@endsection