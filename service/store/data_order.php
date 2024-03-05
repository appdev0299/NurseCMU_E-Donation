<div class="card">
    <div class="card-body">
        <form>
            <?php
            $isMatching = false;
            if (isset($_GET['receipt_id'])) {
                $receiptId = $_GET['receipt_id'];
                require_once 'conf/connection.php';
                $stmt = $conn->prepare("SELECT * FROM store WHERE receipt_id=?");
                $stmt->execute([$_GET['receipt_id']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <div class="mb-3">
                <h6 class="form-label">ข้อมูลหลัก</h6>
            </div>
            <fieldset disabled>
                <div class="row">
                    <div class="position-relative">
                        <div class="chat-box p-12" style="height: calc(100vh - 428px)" data-simplebar="init">
                            <div class="simplebar-wrapper" style="margin: -20px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 20px;">
                                                <div class="chat-list chat" data-user-id="1">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">ชื่อผู้รับ</p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['name_title']; ?> <?= $row['rec_name']; ?> <?= $row['rec_surname']; ?></h6>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">โทรศัพท์</p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['rec_tel']; ?></h6>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <p class="mb-1 fs-2">ที่อยู่จัดส่ง</p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['address']; ?> <?= $row['road']; ?> <?= $row['districts']; ?> <?= $row['amphures']; ?> <?= $row['provinces']; ?> <?= $row['zip_code']; ?></h6>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">หมายเลขออเดอร์</p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['id_receipt']; ?></h6>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">ชุดของที่ระลึก</p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['items_set']; ?></h6>
                                                        </div>
                                                    </div>
                                                    <div class="border-bottom pb-7 mb-4">
                                                        <p class="mb-2 fs-2">หมายเหตุ</p>
                                                        <p class="mb-3 text-dark">
                                                            <?= $row['comment']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="form-label">รายละเอียดการบริจาค</h6>
                                                </div>
                                                <div class="chat-list chat" data-user-id="1">
                                                    <div class="row">
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">โครงการ</p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['edo_description']; ?></h6>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">รหัสโครงการ</p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['edo_pro_id']; ?></h6>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">ยอดเงินบริจาค</p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['amount']; ?> บาท</h6>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">บริจาคผ่านระบบ </p>
                                                            <h6 class="fw-semibold mb-0"><?= $row['status_donat']; ?></h6>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <p class="mb-1 fs-2">วันที่ </p>
                                                            <h6 class="fw-semibold mb-0"><?= thai_date($row['rec_date_out']); ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php
function thai_date($date)
{
    $months = [
        'ม.ค', 'ก.พ', 'มี.ค', 'เม.ย', 'พ.ค', 'มิ.ย',
        'ก.ค', 'ส.ค', 'ก.ย', 'ต.ค', 'พ.ย', 'ธ.ค'
    ];

    $timestamp = strtotime($date);
    $thai_year = date(' Y', $timestamp) + 543;
    $thai_date = date('j ', $timestamp) . $months[date('n', $timestamp) - 1] . ' ' . $thai_year;

    return $thai_date;
}

?>