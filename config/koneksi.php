<?php
// Membuat koneksi ke database MySQL
$koneksi = mysqli_connect("localhost", "root", "", "cafebase") or die("Database Belum Terhubung");

// Definisi class oop untuk manipulasi data
class oop
{
    // Fungsi untuk mengambil semua data dari tabel tertentu
    public function tampil($table)
    {
        global $koneksi;
        $sql = "SELECT * FROM $table"; // Query untuk mengambil semua data
        $query = mysqli_query($koneksi, $sql); // Eksekusi query
        $data = []; // Array kosong untuk menampung data
        while ($tampung = mysqli_fetch_assoc($query)) { // Iterasi setiap hasil query
            $data[] = $tampung; // Menyimpan data ke array
        }
        return $data; // Mengembalikan hasil data
    }

    // Fungsi untuk menyimpan data ke tabel
    public function simpan($con, $table, array $field, $redirect)
    {
        $sql = "INSERT INTO $table SET "; // Membuat query INSERT
        foreach ($field as $key => $value) {
            $sql .= "$key = '$value',"; // Menambahkan pasangan kolom dan nilai
        }
        $sql = rtrim($sql, ','); // Menghapus koma di akhir query
        $query = mysqli_query($con, $sql); // Eksekusi query
        if ($query) {
            echo "<script>alert('Success');document.location.href='$redirect'</script>"; // Pesan sukses
        } else {
            echo $sql; // Menampilkan query untuk debugging jika gagal
        }
    }

    
    /*public function simpan($table,$values,$redirect){
           global $koneksi;
           $sql = "INSERT INTO".$table." VALUES(".$values.")";
           $query = mysqli_query($koneksi,$sql);
           if ($query) {
               echo "<script>alert('Data Berhasil Disimpan');document.location.href='$redirect'</script>";
           }
           else{
               echo mysqli_error($koneksi);
           }
       }*/

// Fungsi untuk mengambil data dengan kondisi tertentu
public function selectWhere($table, $where, $whereValues)
{
    global $koneksi;
    $sql = "SELECT * FROM $table WHERE $where = '$whereValues'"; // Query SELECT dengan WHERE
    $query = mysqli_query($koneksi, $sql); // Eksekusi query
    return $data = mysqli_fetch_assoc($query); // Mengembalikan data dalam array asosiatif
}

// Fungsi untuk menghitung jumlah data berdasarkan kondisi
public function countWhere($field, $name, $table, $where, $value)
{
    global $koneksi;
    $sql = "SELECT COUNT($field) AS $name FROM $table WHERE $where = '$value'"; // Query COUNT
    $query = mysqli_query($koneksi, $sql); // Eksekusi query
    $datas = mysqli_fetch_assoc($query); // Menyimpan hasil query
    return $datas; // Mengembalikan jumlah data
}

// Fungsi untuk mengubah data berdasarkan kondisi tertentu
public function ubah($table, $isi, $where, $whereisi, $redirect)
{
    global $koneksi;
    $sql = "UPDATE $table SET $isi WHERE $where = '$whereisi'"; // Query UPDATE
    $query = mysqli_query($koneksi, $sql); // Eksekusi query
    if ($query) {
        echo "<script>alert('Berhasil');document.location.href='$redirect'</script>"; // Pesan sukses
    } else {
        echo mysqli_error($koneksi); // Menampilkan error jika gagal
    }
}

// Fungsi untuk menghapus data berdasarkan kondisi tertentu
public function delete($table, $where, $whereValues, $redirect)
{
    global $koneksi;
    $sql = "DELETE FROM $table WHERE $where = '$whereValues'"; // Query DELETE
    $query = mysqli_query($koneksi, $sql); // Eksekusi query
    if ($query) {
        echo "<script>alert('Berhasil');document.location.href='$redirect'</script>"; // Pesan sukses
    } else {
        echo mysqli_error($koneksi); // Menampilkan error jika gagal
    }
}

// Fungsi untuk mengupload file ke folder tertentu
public function upload($foto, $folder)
{
    global $koneksi;
    $tmp = $foto["tmp_name"]; // Lokasi file sementara
    $namafile = $foto["name"]; // Nama file
    move_uploaded_file($tmp, "$folder/$namafile"); // Memindahkan file ke folder tujuan
    return $namafile; // Mengembalikan nama file yang diupload
}
}
?>
