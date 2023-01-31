<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Tes Backend!</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('nasabah.index') }}">Nasabah</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('poin.index') }}">Poin</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('report.index') }}">Report</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            @if (Session::has('message'))
                <div class="container">
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show"
                        role="alert">
                        {{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="container">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    + Tambah Transaksi
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Account Id</th>
                            <th>Transaction Date</th>
                            <th>Description</th>
                            <th>Debit Credit Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($collection as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->account_id }}</td>
                                <td>{{ $item->transaction_date }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->debit_credit_status }}</td>
                                <td>{{ $item->amount }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    Data Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('transaksi.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="account_id" class="col-form-label">Pilih Nasabah:</label>
                            <select class="form-control" name="account_id" id="account_id">
                                @foreach ($nasabahCollection as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="transaction_date">Tanggal Transaksi</label>
                            <input type="date" class="form-control" name="transaction_date" id="transaction_date">
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Pilih Jenis Transaksi:</label>
                            <select class="form-control" name="description" id="description">
                                <option value="Setor Tunai">Setor Tunai</option>
                                <option value="Bayar Listrik">Bayar Listrik</option>
                                <option value="Beli Pulsa">Beli Pulsa</option>
                                <option value="Tarik Tunai">Tarik Tunai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="debit_credit_status" class="col-form-label">Pilih Metode Transaksi:</label>
                            <select class="form-control" name="debit_credit_status" id="debit_credit_status">
                                <option value="C">Credit</option>
                                <option value="D">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Nominal</label>
                            <input type="number" class="form-control" name="amount" id="amount"
                                aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
