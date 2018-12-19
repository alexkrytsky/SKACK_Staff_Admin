<?php
/**
 * index.php
 *
 * description
 *
 * Author: Caleb Snoozy
 * Date: 3/7/18
 */

require_once '../../../../common/index.php';
require_once '../../../../common/Account.php';

verify_session(true);

echo json_encode(Account::query_from_id(1)->decode());