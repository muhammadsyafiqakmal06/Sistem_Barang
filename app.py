from flask import Flask, render_template, request, redirect, url_for, session, flash
from flask_mysqldb import MySQL
from sklearn.cluster import KMeans
from sklearn.preprocessing import MinMaxScaler
from sklearn.metrics import silhouette_samples, silhouette_score
from sklearn.preprocessing import StandardScaler
import matplotlib
import os
import hashlib
import pandas as pd
import numpy as np
import seaborn as sns
import matplotlib.pyplot as plt


# Set backend matplotlib ke 'Agg' sebelum mengimpor pyplot

matplotlib.use('Agg')

app = Flask(__name__)

# Konfigurasi database
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'  # Ganti dengan username MySQL Anda
app.config['MYSQL_PASSWORD'] = ''  # Ganti dengan password MySQL Anda
app.config['MYSQL_DB'] = 'perbarang'  # Ganti dengan nama database Anda
app.config['MYSQL_CURSORCLASS'] = 'DictCursor'

# Key untuk session
app.secret_key = 'your_secret_key_here'

mysql = MySQL(app)

# Fungsi untuk enkripsi password menggunakan MD5
def encrypt_password(password):
    return hashlib.md5(password.encode()).hexdigest()

# Halaman Register
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        
        if not username or not password:
            flash('Username dan Password harus diisi', 'error')
            return redirect(url_for('register'))
        
        encrypted_password = encrypt_password(password)

        cur = mysql.connection.cursor()
        cur.execute("INSERT INTO user (username, password) VALUES (%s, %s)", (username, encrypted_password))
        mysql.connection.commit()
        cur.close()

        flash('Registrasi berhasil, silakan login', 'success')
        return redirect(url_for('login'))
    return render_template('register.php')

# Halaman Login
@app.route('/')
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        
        if not username or not password:
            flash('Username dan Password harus diisi', 'error')
            return redirect(url_for('login'))
        
        encrypted_password = encrypt_password(password)

        cur = mysql.connection.cursor()
        cur.execute("SELECT * FROM user WHERE username = %s AND password = %s", (username, encrypted_password))
        user = cur.fetchone()
        cur.close()

        if user:
            session['logged_in'] = True
            flash('Login berhasil', 'success')
            return redirect(url_for('dashboard'))
        else:
            flash('Login gagal. Username atau Password salah.', 'error')

    return render_template('login.php')

# Halaman dashboard
@app.route('/dashboard')
def dashboard():
    if 'logged_in' in session:
        return render_template('dashboard.php')
    else:
        return redirect(url_for('login'))  # Arahkan ke halaman login jika belum login

# Route untuk menampilkan data barang
@app.route('/data_barang')
def data_barang():
    # Pastikan user sudah login
    if 'logged_in' not in session:
        return redirect(url_for('login'))

    page = request.args.get('page', 1, type=int)
    per_page = 30
    offset = (page - 1) * per_page

    cur = mysql.connection.cursor()
    cur.execute("SELECT COUNT(*) FROM data_barang")
    total_count = cur.fetchone()['COUNT(*)']

    cur.execute("SELECT * FROM data_barang LIMIT %s OFFSET %s", (per_page, offset))
    data_barang = cur.fetchall()
    cur.close()

    total_pages = total_count // per_page + (1 if total_count % per_page > 0 else 0)

    return render_template('data_barang.php', data_barang=data_barang, page=page, total_pages=total_pages)

# Route untuk mengedit data barang
@app.route('/edit_barang/<int:id_barang>', methods=['GET', 'POST'])
def edit_barang(id_barang):
    # Pastikan user sudah login
    if 'logged_in' not in session:
        return redirect(url_for('login'))

    # Fetch the data of the item based on its ID
    cur = mysql.connection.cursor()
    cur.execute("SELECT * FROM data_barang WHERE id_barang = %s", (id_barang,))
    data_barang = cur.fetchone()
    cur.close()

    if request.method == 'POST':
        # Get data from the form
        nama_barang = request.form['nama_barang']
        harga = request.form['harga']
        stok_awal = request.form['stok_awal']
        terjual = request.form['terjual']
        stok_akhir = request.form['stok_akhir']

        # Update data in the database
        cur = mysql.connection.cursor()
        cur.execute("UPDATE data_barang SET nama_barang = %s, harga = %s, stok_awal = %s, terjual = %s, stok_akhir = %s WHERE id_barang = %s", (nama_barang, harga, stok_awal, terjual, stok_akhir, id_barang))
        mysql.connection.commit()
        cur.close()

        flash('Data barang berhasil diperbarui')
        return redirect(url_for('data_barang'))

    return render_template('edit_barang.php', data_barang=data_barang)

# Route untuk menghapus data barang
@app.route('/hapus_barang/<int:id_barang>', methods=['POST'])
def hapus_barang(id_barang):
    # Pastikan user sudah login
    if 'logged_in' not in session:
        return redirect(url_for('login'))

    # Hapus data barang dari database
    cur = mysql.connection.cursor()
    cur.execute("DELETE FROM data_barang WHERE id_barang = %s", (id_barang,))
    mysql.connection.commit()
    cur.close()

    flash('Data barang berhasil dihapus')
    return redirect(url_for('data_barang'))

@app.route('/hapus_semua_data', methods=['POST'])
def hapus_semua_data():
    # Pastikan user sudah login
    if 'logged_in' not in session:
        return redirect(url_for('login'))

    # Hapus semua data dari tabel data_barang
    cur = mysql.connection.cursor()
    cur.execute("DELETE FROM data_barang")
    mysql.connection.commit()
    cur.close()

    flash('Semua data berhasil dihapus')
    return redirect(url_for('data_barang'))

# Fungsi untuk memproses file Excel yang diunggah
def process_excel_file(file):
    # Baca file Excel menggunakan pandas
    df = pd.read_excel(file)
    # Loop through each row in the DataFrame
    for index, row in df.iterrows():
        # Ambil data dari setiap kolom
        nama_barang = row['Nama Barang']
        harga = row['Harga']
        stok_awal = row['Stok Awal']
        terjual = row['Terjual']
        stok_akhir = row['Stok Akhir']
        kategori = row.get('Kategori', 'Tidak Ada')

        # Simpan data ke database
        cur = mysql.connection.cursor()
        cur.execute("INSERT INTO data_barang (nama_barang, harga, stok_awal, terjual, stok_akhir, kategori) VALUES (%s, %s, %s, %s, %s, %s)", (nama_barang, harga, stok_awal, terjual, stok_akhir, kategori))
        mysql.connection.commit()
        cur.close()

# Definisikan ekstensi file yang diizinkan
ALLOWED_EXTENSIONS = {'xlsx', 'xls'}

# Fungsi untuk memeriksa apakah ekstensi file diizinkan
def allowed_file(filename):
    return '.' in filename and \
           filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

# Tambahkan route untuk upload file Excel
@app.route('/upload_excel', methods=['POST'])
def upload_excel():
    if 'file' not in request.files:
        flash('No file part', 'error')
        return redirect(url_for('dashboard'))
    file = request.files['file']
    if file.filename == '':
        flash('No selected file', 'error')
        return redirect(url_for('dashboard'))
    if file and allowed_file(file.filename):
        process_excel_file(file)
        flash('File uploaded successfully', 'success')
        return redirect(url_for('dashboard'))
    else:
        flash('Invalid file format', 'error')
        return redirect(url_for('dashboard'))

# Fungsi logout
@app.route('/logout')
def logout():
    session.pop('logged_in', None)  # Hapus session saat logout
    return redirect(url_for('login'))  # Arahkan kembali ke halaman login setelah logout

@app.route('/pengelompokan')
def pengelompokan():
    return render_template('pengelompokan.php')

def get_data_from_db():
    cursor = mysql.connection.cursor()
    query = "SELECT id_barang, stok_akhir, terjual FROM data_barang"
    cursor.execute(query)
    data = cursor.fetchall()
    cursor.close()
    df = pd.DataFrame(data)
    return df

def analyze_data_and_save_images():
    # Mengambil data dari database
    df = get_data_from_db()

    # Convert columns to numeric
    df['stok_akhir'] = pd.to_numeric(df['stok_akhir'])
    df['terjual'] = pd.to_numeric(df['terjual'])

    # Plotting sebelum clustering
    plt.figure(figsize=(10, 6))
    sns.scatterplot(x='stok_akhir', y='terjual', data=df, s=100, color="red", alpha=0.5)
    plt.title('Data Barang Sebelum Clustering')
    plt.xlabel('stok_akhir')
    plt.ylabel('terjual')
    
    # Adjust scale
    plt.xticks(rotation=90)
    plt.xlim(df['stok_akhir'].min() - 10, df['stok_akhir'].max() + 10)
    plt.ylim(df['terjual'].min() - 10, df['terjual'].max() + 10)
    
    # Save image before showing the plot
    image_path_before = os.path.join('static', 'data_sebelum_clustering.png')
    plt.savefig(image_path_before)
    plt.close()

   # Skalakan data sebelum klastering dengan StandardScaler
    scaler_standard = StandardScaler()
    x_scaled = scaler_standard.fit_transform(df[['stok_akhir', 'terjual']])

    # Klastering menggunakan K-Means
    kmeans = KMeans(n_clusters=3, random_state=42)
    df['kategori'] = kmeans.fit_predict(x_scaled)

    # Menggunakan MinMaxScaler untuk menskalakan data dan pusat klaster ke rentang 0-1 hanya untuk keperluan plotting
    scaler_minmax = MinMaxScaler()
    x_scaled_minmax = scaler_minmax.fit_transform(x_scaled)
    centers_minmax = scaler_minmax.transform(kmeans.cluster_centers_)

    # Plotting setelah clustering
    plt.figure(figsize=(10, 6))
    sct = plt.scatter(x_scaled_minmax[:, 0], x_scaled_minmax[:, 1], s=100, c=df['kategori'], marker="o", alpha=0.5, label=df['kategori'])
    plt.scatter(centers_minmax[:, 0], centers_minmax[:, 1], c='blue', s=200, alpha=0.5, edgecolor='k')
    plt.title("Hasil Klustering K-Means")
    plt.xlabel("Scaled stok_akhir")
    plt.ylabel("Scaled terjual")
    image_path_after = os.path.join('static', 'data_setelah_clustering.png')
    plt.savefig(image_path_after)
    plt.close()

    # Menampilkan plot
    plt.show()

    # Silhouette analysis
    score = silhouette_score(x_scaled, kmeans.labels_, metric='euclidean')
    print('Silhouette Score: %.3f' % score)

    # Menghitung silhouette score pada setiap data
    silhouette_values = silhouette_samples(x_scaled, kmeans.labels_, metric='euclidean')
    df['Silhouette Score'] = silhouette_values

    # Visualisasikan silhouette scores untuk setiap data point
    plt.figure(figsize=(8, 6))
    plt.scatter(range(len(df)), silhouette_values, c=df['kategori'], cmap='viridis')
    plt.xlabel('Data Point Index')
    plt.ylabel('Silhouette Score')
    plt.title('Silhouette Scores for Data Points')
    image_path_silhouette = os.path.join('static', 'silhouette_scores.png')
    plt.savefig(image_path_silhouette)
    plt.close()

    # Mapping kategori ke kategori
    for index, row in df.iterrows():
        if row['kategori'] == 2:
            df.loc[index, 'Kategori'] = 'Paling Diminati'
        elif row['kategori'] == 1:
            df.loc[index, 'Kategori'] = 'Diminati'
        elif row['kategori'] == 0:
            df.loc[index, 'Kategori'] = 'Kurang Diminati'
        else:
            df.loc[index, 'Kategori'] = 'Kategori Tidak Temukan'
    
    # Hapus kolom 'kategori' setelah mapping
    df.drop(columns=['kategori'], inplace=True)

    return df, image_path_before, image_path_after, image_path_silhouette

def save_clusters_to_db(df):
    cursor = mysql.connection.cursor()
    for index, row in df.iterrows():
        cursor.execute("UPDATE data_barang SET kategori = %s WHERE id_barang = %s", (row['Kategori'], row['id_barang']))
    mysql.connection.commit()
    cursor.close()

@app.route('/analyze', methods=['GET'])
def analyze():
    # Melakukan analisis data dan menyimpan gambar visualisasi
    df, image_path_before, image_path_after, image_path_silhouette = analyze_data_and_save_images()
    
    # Menyimpan hasil clustering ke database
    save_clusters_to_db(df)
    
    # Menampilkan notifikasi bahwa clustering berhasil
    flash('Clustering berhasil dilakukan dan hasil disimpan ke database', 'success')
    
    # Ambil hanya nama file dari path
    image_path_before = os.path.basename(image_path_before)
    image_path_after = os.path.basename(image_path_after)
    image_path_silhouette = os.path.basename(image_path_silhouette)
    
    return render_template('pengelompokan.php', 
                           image_path_before=image_path_before, 
                           image_path_after=image_path_after, 
                           image_path_silhouette=image_path_silhouette)

if __name__ == '__main__':
    app.run(debug=True)