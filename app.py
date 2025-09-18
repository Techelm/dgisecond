from flask import Flask, render_template, request, redirect, url_for, session, flash
from flask_sqlalchemy import SQLAlchemy
from datetime import datetime

app = Flask(__name__)
# app.config['SECRET_KEY'] = 'your_secret_key_here'
app.secret_key = "my secrete key here"
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///users.db'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

#keeping the user information
class User(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(80), unique=True, nullable=False)
    password = db.Column(db.String(120), nullable=False)
    position = db.Column(db.String(200), default="member")
    email = db.Column(db.String(200), nullable=False)
    img_url = db.Column(db.String(200), default="/static/sample.jpg")
    year = db.Column(db.String(200), default="1")
    confirmed = db.Column(db.String(10), default="no")

#messeges by admin
class Message(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(80), unique=True, nullable=False)
    body = db.Column(db.String(120), nullable=False)
    datecreated = db.Column(db.DateTime, default=datetime.utcnow)
    creator = db.Column(db.String(200), nullable=False)

#events
class Events(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    title = db.Column(db.String(200), nullable=False)
    content = db.Column(db.Text, nullable=False)
    date = db.Column(db.String(200), nullable=False)
    
class Votes(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    voter = db.Column(db.String(200), nullable=False)
    candidate = db.Column(db.String(200), nullable=False)
    datevoted = db.Column(db.DateTime, default=datetime.utcnow)
    

# -------------------- Member/User Routes --------------------
@app.route('/')
def member_home():
    return render_template('index.html')

@app.route('/login', methods=['GET', 'POST'])
def member_login():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')
        user = User.query.filter_by(username=username, password=password).first()
        if user and user.confirmed == "yes":
            #storing the info in the session so that i can use them in different routes
            session['username'] = user.username
            session["img_url"] = user.img_url
            session["year"] = user.year
            session["position"] = user.position
            session["email"] = user.email
            session["confirmed"] = user.confirmed
 
            #verifying if the user an admin
            if user.position == "admin":
                flash('Login as admin successful!', 'success')
                return redirect(url_for('admin_dashboard'))
            
            elif user.position == "developer":
                return redirect(url_for('developer_darshboard'))
            flash('Login successful!', 'success')
            #return redirect(url_for('member_darshboard'))
            return render_template("darshboard.html")
        else:
            flash('Invalid username or password', 'danger')
    return render_template('/home/login.html')

#sending function
def send_message(title, body):
    msg = Message(title=title, body=body)
    db.session.add(msg)
    db.session.commit()



#sending message
@app.route("/sendmessage", methods=["POST", "GET"])
def sendmessage():
    title = request.form.get('title')
    body = request.form.get('body')
    #add the sender use the info by the id
    send_message(title, body)
    flash("messege sent")
    return redirect(url_for("admin_darshboard"))

#donations
@app.route("/donate")
def donate():
    return render_template("donate.html")

#________________member routes___________________
@app.route('/events')
def member_events():
    if 'username' not in session:
        return redirect(url_for('login'))
    return render_template('events.html')


@app.route('/darshboard')
def member_darshboard():
    if 'username' not in session:
        return redirect(url_for('login'))
    return render_template('member/darshboard.html', username=session.get("username"))

# @app.route('/member/members')
# def member_members():
#     if 'username' not in session:
#         return redirect(url_for('login'))
#     return render_template('members.html')

@app.route('/messages')
def member_messages():
    if 'username' not in session:
        return redirect(url_for('login'))
    return render_template('messages.html')

@app.route('/member/resources')
def member_resources():
    if 'username' not in session:
        return redirect(url_for('login'))
    return render_template('resources.html')

@app.route('/member/voting', methods=['GET', 'POST'])
def member_voting():
    if 'username' not in session:
        return redirect(url_for('login'))
    return render_template('voting.html')

@app.route('/member/logout')
def member_logout():
    session.pop('username', None)
    session.pop('is_admin', None)
    flash('Logged out successfully.', 'info')
    return redirect(url_for('login'))

# -------------------- Admin Routes --------------------
@app.route('/admin/admin_darshboard')
def admin_darshboard():
    if session.get("position") != "admin":
        return redirect(url_for('login'))
    users = User.query.order_by(User.id.desc()).all()
    users_count = User.query.count()
    return render_template('admin_darshboard.html',users_count=users_count, username=session.get('username'), year=session.get('year'), img_url=session.get('ing_url'), email=session.get('email'), users=users)

@app.route("/developer/")
def developer():
    if session.get("position") != "developer":
        return redirect(url_for('login'))
    return render_template("developer_darshboard.html", username=session.get('username'))


@app.route('/register', methods=['GET', 'POST'])
def member_register():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password')
        position = request.form.get('position')
        email = request.form.get('email')
        img_url = request.form.get('image')
        confirmed = request.form.get('confirmed')
        year = request.form.get('year')

        if not username or not password:
            flash('Please fill out all fields.', 'danger')
        elif User.query.filter_by(username=username).first():
            flash('Username already exists', 'danger')
        else:
            new_user = User(username=username, password=password, position=position, email=email, img_url=img_url, year=year, confirmed=confirmed)
            db.session.add(new_user)
            db.session.commit()
            flash('Registration successful! Please login.', 'success')
            return redirect(url_for('login'))
    return render_template('home/register.html')



@app.route('/member/dashboard')
def member_dashboard():
    if 'username' not in session:
        return redirect(url_for('login'))
    messages = Message.query.order_by(Message.datecreated.desc()).all()
    return render_template('member_darshboard.html',messages=messages, username=session.get('username'), year=session.get('year'), img_url=session.get('ing_url'), email=session.get('email'))

@app.route('/admin/admin_events', methods=['GET', 'POST'])
def admin_events():
    if session.get("position") != "admin":
        return redirect(url_for('login'))
    if request.method == 'POST':
        title = request.form.get('title')
        content = request.form.get('content')
        date = request.form.get('date')
        new_event = Events(title=title, content=content, date=date)
        db.session.add(new_event)
        db.session.commit()
        flash('Event created successfully!', 'success')
        return redirect(url_for('admin_events'))
    events = Events.query.order_by(Events.date.desc()).all()
    return render_template('admin_events.html', events=events)

@app.route('/admin/admin_members', methods=['GET', 'POST'])
def admin_members():
    if session.get("position") != "admin":
        return redirect(url_for('login'))
    users = User.query.order_by(User.id.desc()).all()
    return render_template('admin_members.html', users=users)

@app.route('/admin/admin_messages', methods=['GET', 'POST'])
def admin_messages():
    if session.get("position") != "admin":
        return redirect(url_for('login'))
    messages = Message.query.order_by(Message.datecreated.desc()).all()
    return render_template('admin_messages.html', messages=messages)

@app.route('/admin/admin_resources', methods=['GET', 'POST'])
def admin_resources():
    if session.get("position") != "admin":
        return redirect(url_for('login'))
    return render_template('admin_resources.html')

@app.route('/admin/admin_voting', methods=['GET', 'POST'])
def admin_voting():
    if session.get("position") != "admin":
        return redirect(url_for('login'))
    if request.method == 'POST':
        voter = request.form.get('voter')
        candidate = request.form.get('candidate')
        new_vote = Votes(voter=voter, candidate=candidate)
        db.session.add(new_vote)
        db.session.commit()
        flash('Vote recorded successfully!', 'success')
        return redirect(url_for('admin_voting'))
    votes = Votes.query.order_by(Votes.datevoted.desc()).all()
    return render_template('admin_voting.html', votes=votes)

if __name__ == '__main__':
    with app.app_context():
        db.create_all()
    app.run(debug=True)
