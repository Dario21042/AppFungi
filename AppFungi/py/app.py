

from flask import Flask, render_template, request, redirect, session
from flask_sqlalchemy import SQLAlchemy


app = Flask(__name__)
app.secret_key = '1234'  # Clave secreta para la sesión
app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://usuario:1234@localhost/ReinoFungi'
db = SQLAlchemy(app)

# Definir el modelo de usuario
class User(db.Model): # type: ignore
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(50), unique=True)
    password = db.Column(db.String(100))

    def __init__(self, username, password):
        self.username = username
        self.password = password

# Página de inicio de sesión
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        user = User.query.filter_by(username=username).first()

        if user and user.password == password:
            session['username'] = username  # Iniciar sesión
            return redirect('/dashboard')
        else:
            error = 'Credenciales inválidas. Por favor, inténtalo de nuevo.'
            return render_template('login.html', error=error)
    

    return render_template('login.html')

# Página de registro
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        user = User.query.filter_by(username=username).first()

        if user:
            error = 'El nombre de usuario ya existe. Por favor, elige otro.'
            return render_template('register.html', error=error)
        else:
            new_user = User(username, password)
            db.session.add(new_user)
            db.session.commit()
            session['username'] = username  # Iniciar sesión
            return redirect('/dashboard')
    
    return render_template('register.html')

# Página del panel de control después de iniciar sesión
@app.route('/dashboard')
def dashboard():
    if 'username' in session:
        return render_template('dashboard.html', username=session['username'])
    else:
        return redirect('/login')

# Cerrar sesión
@app.route('/logout')
def logout():
    session.pop('username', None)
    return redirect('/login')

if __name__ == '__main__':
    db.create_all()  # Crear las tablas en la base de datos
    app.run(debug=True)
