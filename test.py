from turtle import *
import time

# Setup screen
screen = Screen()
screen.bgcolor("white")
screen.title("Dependency Injection in OOP")

# Create turtle objects
car = Turtle()
engine = Turtle()
text =Turtle()

# Setup turtles
for t in [car, engine, text]:
    t.speed(2)
    t.hideturtle()

# Draw car
car.penup()
car.goto(-100, 0)
car.pendown()
car.color("blue")
car.begin_fill()
for _ in range(2):
    car.forward(200)
    car.left(90)
    car.forward(100)
    car.left(90)
car.end_fill()

# Draw engine
engine.penup()
engine.goto(-30, -80)
engine.pendown()
engine.color("gray")
engine.begin_fill()
for _ in range(2):
    engine.forward(60)
    engine.left(90)
    engine.forward(40)
    engine.left(90)
engine.end_fill()

# Animation: Injecting engine into car
engine.penup()
engine.goto(-30, -80)
time.sleep(1)
for i in range(80):
    engine.goto(-30, -80 + i)
    time.sleep(0.02)

# Display text
text.penup()
text.goto(-90, 120)
text.color("black")
text.write("Dependency Injection in OOP\nEngine is injected into Car", align="center", font=("Arial", 14, "bold"))

# Finish
screen.mainloop()
