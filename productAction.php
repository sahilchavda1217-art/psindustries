<?php
include('db.php');

// Ensure uploads directory exists
if (!is_dir('uploads/products')) {
    mkdir('uploads/products', 0755, true);
}

$action = $_POST['action'] ?? '';

// ===================== ADD PRODUCT =====================
if ($action === 'add') {
    $name        = trim($_POST['name'] ?? '');
    $category    = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $specs       = trim($_POST['specs'] ?? '');
    $is_active   = isset($_POST['is_active']) ? 1 : 0;
    $image_path  = '';

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $ext       = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed   = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (in_array($ext, $allowed)) {
            $filename   = 'prod_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $dest       = 'uploads/products/' . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                $image_path = $filename;
            }
        }
    }

    $name        = mysqli_real_escape_string($conn, $name);
    $category    = mysqli_real_escape_string($conn, $category);
    $description = mysqli_real_escape_string($conn, $description);
    $specs       = mysqli_real_escape_string($conn, $specs);

    $sql = "INSERT INTO products (name, category, description, specs, image_path, is_active)
            VALUES ('$name', '$category', '$description', '$specs', '$image_path', $is_active)";
    mysqli_query($conn, $sql);

    header('Location: adminProducts.php?msg=Product+added+successfully');
    exit;
}

// ===================== EDIT PRODUCT =====================
if ($action === 'edit') {
    $id          = intval($_POST['id']);
    $name        = trim($_POST['name'] ?? '');
    $category    = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $specs       = trim($_POST['specs'] ?? '');
    $is_active   = isset($_POST['is_active']) ? 1 : 0;

    $name        = mysqli_real_escape_string($conn, $name);
    $category    = mysqli_real_escape_string($conn, $category);
    $description = mysqli_real_escape_string($conn, $description);
    $specs       = mysqli_real_escape_string($conn, $specs);

    // Handle new image upload (optional)
    $image_sql = '';
    if (!empty($_FILES['image']['name'])) {
        $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (in_array($ext, $allowed)) {
            $filename = 'prod_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $dest     = 'uploads/products/' . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                // Delete old image
                $old = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image_path FROM products WHERE id=$id"));
                if ($old && $old['image_path'] && file_exists('uploads/products/' . $old['image_path'])) {
                    unlink('uploads/products/' . $old['image_path']);
                }
                $image_sql = ", image_path='$filename'";
            }
        }
    }

    $sql = "UPDATE products SET
                name='$name',
                category='$category',
                description='$description',
                specs='$specs',
                is_active=$is_active
                $image_sql
            WHERE id=$id";
    mysqli_query($conn, $sql);

    header('Location: adminProducts.php?msg=Product+updated+successfully');
    exit;
}

// ===================== DELETE PRODUCT =====================
if ($action === 'delete') {
    $id  = intval($_POST['id']);
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT image_path FROM products WHERE id=$id"));
    if ($row && $row['image_path'] && file_exists('uploads/products/' . $row['image_path'])) {
        unlink('uploads/products/' . $row['image_path']);
    }
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header('Location: adminProducts.php?msg=Product+deleted');
    exit;
}

// ===================== TOGGLE ACTIVE =====================
if ($action === 'toggle') {
    $id  = intval($_POST['id']);
    mysqli_query($conn, "UPDATE products SET is_active = 1 - is_active WHERE id=$id");
    header('Location: adminProducts.php?msg=Status+updated');
    exit;
}

header('Location: adminProducts.php');
exit;
