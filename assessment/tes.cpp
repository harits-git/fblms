#include <gl/glut.h>

void renderScene(){

}

void main(int argc, char **argv){
    glutInit(&argc, argv);
	glutInitWindowSize(480,480);

	glutCreateWindow("Primitives");
	gluOrtho2D(-200.,200.,-200.,200.);
	glutDisplayFunc(renderScene);

	glutMainLoop();
}
