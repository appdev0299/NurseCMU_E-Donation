<div class="table-responsive">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['display_data'])) {
            $itemsPerPage = 10;
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            $sql = "SELECT * FROM ";

            if (isset($_POST['showall']) && !empty($_POST['showall'])) {
                $selected_table = $_POST['showall'];
                $sql .= $selected_table;
            } else {
                $sql .= "receipt";
            }

            $sql .= " WHERE 1=1";

            if (isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $sql .= " AND rec_date_out BETWEEN :start_date AND :end_date";
            }

            if (isset($_POST['status_user']) && !empty($_POST['status_user'])) {
                $selected_status_user = $_POST['status_user'];
                $sql .= " AND status_user = :status_user";
            }

            if (isset($_POST['status_receipt']) && !empty($_POST['status_receipt'])) {
                $selected_status_receipt = $_POST['status_receipt'];
                $sql .= " AND status_receipt = :status_receipt";
            }

            if (isset($_POST['edo_pro_id']) && !empty($_POST['edo_pro_id'])) {
                $selected_edo_pro_id = $_POST['edo_pro_id'];
                $sql .= " AND edo_pro_id = :edo_pro_id";
            }

            if (isset($_POST['receipt_cc']) && !empty($_POST['receipt_cc'])) {
                $selected_receipt_cc = $_POST['receipt_cc'];
                $sql .= " AND receipt_cc = :receipt_cc";
            }

            $sql .= " ORDER BY receipt_id DESC";
            $offset = ($currentPage - 1) * $itemsPerPage;
            $sql .= " LIMIT $itemsPerPage OFFSET $offset";
            $stmt = $conn->prepare($sql);

            if (isset($start_date) && isset($end_date)) {
                $stmt->bindParam(':start_date', $start_date);
                $stmt->bindParam(':end_date', $end_date);
            }

            if (isset($selected_status_user)) {
                $stmt->bindParam(':status_user', $selected_status_user);
            }

            if (isset($selected_status_receipt)) {
                $stmt->bindParam(':status_receipt', $selected_status_receipt);
            }

            if (isset($selected_edo_pro_id)) {
                $stmt->bindParam(':edo_pro_id', $selected_edo_pro_id);
            }

            if (isset($selected_receipt_cc)) {
                $stmt->bindParam(':receipt_cc', $selected_receipt_cc);
            }

            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($results) > 0) {
    ?>
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">ลำดับ</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">ชื่อ-นามสกุล</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">ที่อยู่</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">วันที่บริจาค</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($results as $row) :
                        ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0"><?= $i++; ?></h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"><?= $row['name_title']; ?> <?= $row['rec_name']; ?> <?= $row['rec_surname']; ?></h6>
                                    <span class="fw-normal"><?= $row['id_receipt']; ?></span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal"><?= $row['address']; ?> <?= $row['road']; ?> <?= $row['districts']; ?> <?= $row['amphures']; ?> <?= $row['provinces']; ?></p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                $totalPages = ceil(count($results) / $itemsPerPage);
                if ($totalPages > 1) {
                ?>
                    <div class="text-center mt-4">
                        <ul class="pagination justify-content-center">
                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
    <?php
                } else {
                    echo "Total pages is not set.";
                }
            } else {
                echo "No data found.";
            }
        }
    }
    ?>
</div>