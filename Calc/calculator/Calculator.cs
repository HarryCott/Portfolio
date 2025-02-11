using System;

namespace SimpleCalculator
{
    /// <summary>
    /// A static class that performs arithmetic operations.
    /// </summary>
    static class Calculator
    {
        /// <summary>
        /// Adds two numbers.
        /// </summary>
        public static double Add(double a, double b) => a + b;

        /// <summary>
        /// Subtracts the second number from the first.
        /// </summary>
        public static double Subtract(double a, double b) => a - b;

        /// <summary>
        /// Multiplies two numbers.
        /// </summary>
        public static double Multiply(double a, double b) => a * b;

        /// <summary>
        /// Divides the first number by the second.
        /// </summary>
        /// <param name="a">The dividend.</param>
        /// <param name="b">The divisor. Must not be zero.</param>
        /// <returns>The result of the division.</returns>
        /// <exception cref="DivideByZeroException">Thrown when b is zero.</exception>
        public static double Divide(double a, double b)
        {
            if (b == 0)
            {
                throw new DivideByZeroException("Cannot divide by zero.");
            }
            return a / b;
        }
    }
}
