<?php
include('login_info.php');
?>
<div class="card">
    <div class="card-body">
        <form>
            <?php
            $isMatching = false;
            if (isset($_GET['receipt_id'])) {
                require_once 'conf/connection.php';
                $stmt = $conn->prepare("SELECT * FROM receipt WHERE receipt_id=?");
                $stmt->execute([$_GET['receipt_id']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt_confirm = $conn->prepare("SELECT * FROM json_confirm WHERE billPaymentRef1=?");
                $stmt_confirm->execute([$row['ref1']]);
                $row_confirm = $stmt_confirm->fetch(PDO::FETCH_ASSOC);

                $isMatchingIdName = ($row['rec_idname'] == $row_confirm['billPaymentRef2']);
                $isMatchingAmount = ($row['amount'] == $row_confirm['amount']);
                $isMatchingDate = ($row['rec_date_out'] == $row_confirm['date']);
                $isMatchingRef1 = ($row['ref1'] == $row_confirm['billPaymentRef1']);
                $isMatchingRef2 = ($row['rec_idname'] == $row_confirm['billPaymentRef2']);
            }
            ?>
            <div class="mb-3">
                <h6 class="form-label">ข้อมูลหลัก</h6>
            </div>
            <fieldset disabled>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="paycheckname" class="form-label">ชื่อ-นานสกุล/บริษัท/นิติบุคคล</label>
                            <input id="paycheckname" class="form-control" type="text" value="<?= $row['name_title']; ?> <?= $row['rec_name']; ?> <?= $row['rec_surname']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="paychecknameid" class="form-label">เลขประจำตัวประชาชน/เลขประจำตัวผู้เสียภาษี</label>
                            <input id="paychecknameid" class="form-control <?= $isMatchingIdName ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row['rec_idname']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="paycheckamount" class="form-label">จำนวนเงิน</label>
                            <input id="paycheckamount" class="form-control <?= $isMatchingAmount ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= number_format($row['amount'], 2, '.', ','); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="paycheckdate" class="form-label">วันที่โอน</label>
                            <input id="paycheckdate" class="form-control <?= $isMatchingDate ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row['rec_date_out']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="paycheckref1" class="form-label">หมายเลขอ้างอิง (REF1)</label>
                            <input id="paycheckref1" class="form-control <?= $isMatchingRef1 ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row['ref1']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="paycheckref2" class="form-label">หมายเลขอ้างอิง (REF2)</label>
                            <input id="paycheckref2" class="form-control <?= $isMatchingRef2 ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row['rec_idname']; ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <h6 class="form-label">ข้อมูลยืนยัน (จากธนาคาร)</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bank_confirm_name" class="form-label">ชื่อ-นานสกุล/บริษัท/นิติบุคคล</label>
                                <input id="bank_confirm_name" class="form-control" type="text" value="<?= $row_confirm['payerAccountName'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bank_confirm_id" class="form-label">เลขประจำตัวประชาชน/เลขประจำตัวผู้เสียภาษี</label>
                                <input id="bank_confirm_id" class="form-control <?= $isMatchingIdName ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row_confirm['billPaymentRef2'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="bank_confirm_amount" class="form-label">จำนวนเงิน</label>
                                <input id="bank_confirm_amount" class="form-control <?= $isMatchingAmount ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row_confirm['amount'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="bank_confirm_date" class="form-label">วันที่โอน</label>
                                <input id="bank_confirm_date" class="form-control <?= $isMatchingDate ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row_confirm['date'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="bank_confirm_ref1" class="form-label">หมายเลขอ้างอิง (REF1)</label>
                                <input id="bank_confirm_ref1" class="form-control <?= $isMatchingRef1 ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row_confirm['billPaymentRef1'] ?? ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="bank_confirm_ref2" class="form-label">หมายเลขอ้างอิง (REF2)</label>
                                <input id="bank_confirm_ref2" class="form-control <?= $isMatchingRef2 ? 'border-success' : 'border-danger'; ?>" type="text" value="<?= $row_confirm['billPaymentRef2'] ?? ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>