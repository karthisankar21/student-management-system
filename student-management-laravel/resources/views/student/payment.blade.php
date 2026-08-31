<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <h2>Payment Page</h2>

    <form action="{{ route('payment', ['id' => $studentId]) }}" method="POST">
        @csrf
            
        <label for="student_name">Student Name:</label>
        <input
            type="text"
            id="student_name"
            name="student_name"
            class="form-control mb-2"
            placeholder="Student Name"
            value="{{ $student->name }}"
            readonly>


        <label for="student_course">Course</label>
        <input
            type="text"
            id="student_course"
            class="form-control"
            placeholder="Student Course"
            value="{{ $student->course }}"
            readonly>


        <label for="amount">Amount:</label>
        <input
            type="number"
            id="amount"
            name="amount"
            class="form-control mb-2"
            placeholder="Amount"
            value="{{ old('amount') }}"
            required>

        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" class="form-control mb-2" required>
            <option value="GooglePay">GooglePay</option>
            <option value="Phonepay">Phonepay</option>
            <option value="paytm">paytm</option>
            <option value="Cards">Cards</option>
        </select><br>

        <button type="submit" class="btn btn-primary">Pay</button>
    </form>
</body>

</html>



